<?php

namespace App\Http\Controllers\EmailValidation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmailValidation\ValidEmail;
use App\Models\EmailValidation\InvalidEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\EmailValidation\EmailFilter;


class EmailValidationController extends Controller
{

    public function showForm()
    {
        // Query for counts grouped by 'created_by' and 'email_status'
        $emailStatusCounts = DB::table('valid_emails')
            ->select('created_by', 'email_status', DB::raw('COUNT(*) as count'))
            ->groupBy('created_by', 'email_status')
            ->get();
    
        // Initialize array to hold email counts by user and status
        $emailCounts = [];
    
        // Process the counts based on email_status
        foreach ($emailStatusCounts as $entry) {
            $user = $entry->created_by;
            $status = $entry->email_status;
    
            switch ($status) {
                case 0:
                    $emailCounts[$user]['invalid_count'] = $entry->count;
                    break;
                case 1:
                    $emailCounts[$user]['valid_count'] = $entry->count;
                    break;
                case 2:
                    $emailCounts[$user]['duplicate_count'] = $entry->count;
                    break;
                default:
                    break;
            }
        }
    
        // Retrieve the list of users who have created valid emails
        $createdByNames = DB::table('valid_emails')
            ->select('created_by')
            ->groupBy('created_by')
            ->get();
    
        // Pass the data to the view
        return view('emailvalidation.email-form', compact('emailCounts', 'createdByNames'));
    }
    

    /**
     * Validate the submitted emails and store in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */

     
     public function validateEmail(Request $request)
     {
         // Step 1: Validate the request
         $request->validate([
             'allemail' => 'required|string',
         ]);
     
         // Step 2: Split emails by line break and remove empty spaces
         $emails = explode("\n", $request->input('allemail'));
         $emails = array_map('trim', $emails);
     
         // Step 3: Fetch filters dynamically from the database
         $filterWith = EmailFilter::pluck('filter_value')->toArray();
     
         $allEmails = [];
         $currentUserName = Auth::user()->firstname;
         $created_by_userId = Auth::user()->user_id;
     
         // Define batch size for chunk processing
         $batchSize = 2000;
         $chunks = array_chunk($emails, $batchSize);
     
         foreach ($chunks as $chunk) {
             foreach ($chunk as $email) {
                 if (empty($email)) {
                     continue;
                 }
     
                 $isInvalid = false;
                 foreach ($filterWith as $value) {
                     $emailFirstData = explode('@', $email);
                     $domainParts = explode('.', $email);
                     $emailLastData = end($domainParts);
     
                     // Apply your custom filtering logic
                     if (
                         ($emailFirstData[0] == $value) || 
                         (is_numeric($emailFirstData[0])) || 
                         (ctype_digit(substr($emailFirstData[0], 0, 1))) ||
                         (substr($emailFirstData[0], 0, 1) === '.') ||
                         (strpos($email, '..') !== false) ||
                         (isset($emailLastData) && $emailLastData !== "com")
                     ) {
                         $isInvalid = true;
                         break;
                     }
                 }
     
                 $emailStatus = $isInvalid ? 0 : 1;
     
                 // Prepare the array for bulk insert
                 $allEmails[] = [
                     'valid_email' => $email,
                     'email_status' => $emailStatus,
                     'created_by' => $currentUserName,
                     'created_by_userId' => $created_by_userId
                 ];
             }
     
             // Step 4: Insert emails in bulk
             if (!empty($allEmails)) {
                 try {
                     DB::beginTransaction();
     
                     DB::table('valid_emails')->insert($allEmails);
     
                     DB::commit();
                 } catch (Exception $e) {
                     DB::rollBack();
                     return back()->withErrors(['error' => 'Failed to insert emails.']);
                 }
             }
     
             // Clear the allEmails array after each chunk is processed
             $allEmails = [];
         }
     
         // Step 5: Update email_status to 2 for duplicate entries
         try {
             DB::beginTransaction();
     
             DB::statement("
                 UPDATE valid_emails n1
                 INNER JOIN valid_emails n2 
                 ON n1.valid_email = n2.valid_email 
                 SET n1.email_status = 2
                 WHERE n1.id > n2.id
             ");
     
             DB::commit();
         } catch (Exception $e) {
             DB::rollBack();
             return back()->withErrors(['error' => 'Failed to update duplicate emails.']);
         }
     
         // Step 6: Return success response
         return back()->with('success', 'Emails processed successfully.');
     }
     
     
     
     public function exportValidEmails(Request $request)
     {
         $createdBy = $request->input('created_by');
         $currentUserId = auth()->user()->user_id; // Use 'user_id' for current user ID
     
         try {
             // Initialize the query to select only valid emails
             $query = DB::table('valid_emails')
                 ->select('valid_email', 'created_by', 'id')
                 ->where('email_status', 1); // Only export valid emails with email_status = 1
     
             // Check if the user is not super admin (user_id != 10)
             if ($createdBy == NULL && $currentUserId != 10) {
                 // Filter by the current user's ID
                 $query->where('created_by_userId', $currentUserId);
             }
     
             // Additional filter based on created_by if provided
             if ($createdBy && $createdBy !== 'all') {
                 $query->where('created_by', $createdBy);
             }
     
             $validEmails = $query->get();
     
             if ($validEmails->count() > 0) {
                 $filename = "valid_emails_" . date('Ymd') . ".csv";
     
                 // Prepare CSV headers
                 $headers = array(
                     "Content-type" => "text/csv",
                     "Content-Disposition" => "attachment; filename=$filename",
                     "Pragma" => "no-cache",
                     "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
                     "Expires" => "0"
                 );
     
                 // Callback function to generate CSV file
                 $callback = function () use ($validEmails) {
                     $file = fopen('php://output', 'w');
                     fputcsv($file, ['Email', 'Created By']); // CSV headers
     
                     foreach ($validEmails as $email) {
                         fputcsv($file, [$email->valid_email, $email->created_by]);
                     }
     
                     fclose($file);
                 };
     
                 $response = Response::stream($callback, 200, $headers);
     
                 // Truncate the valid_emails table after exporting
                //  DB::table('valid_emails')->where('email_status', 1)->delete();
     
                 DB::table('valid_emails')->truncate();
     
                 return $response;
             } else {
                 return back()->with('error', 'No valid emails found.');
             }
         } catch (\Exception $e) {
             return back()->with('error', 'Error exporting emails: ' . $e->getMessage());
         }
     }
     
}
