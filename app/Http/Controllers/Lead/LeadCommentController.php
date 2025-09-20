<?php

namespace App\Http\Controllers\Lead;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use App\Models\Lead\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Lead\LeadEndClientOrCompanyName;

class LeadCommentController extends Controller
{
    public function show(Lead $lead)
    {
        $leadData = Lead::with([
        'company', 'vendor', 
        'interviewer', 'createdUser', 
        'technology', 'leadStatus',
        'leadSupportedBy'
         ])
        ->where('leads.id', '=', $lead->id)
        ->first();

        // Fetch lead histories
        $leadHistories = LeadHistory::where('lead_id', $lead->id)
        ->orderBy('created_at', 'ASC')
        ->with('leadStatus')
        ->with('user') // Load the user relationship
        ->get();
     
        // Retrieve LeadEndClientOrCompanyNames
        $LeadEndClientOrCompanyNames = LeadEndClientOrCompanyName::where('lead_id', $lead->id)->get();
       
        return view('lead.show-lead', compact(
         'leadData',
         'leadHistories', 
         'LeadEndClientOrCompanyNames'
        ));
    } 

    public function store(Request $request)
    {
      
        // Validate incoming request data as needed
        $request->validate([
            'lead_id' => 'required|int',
            'lead_comment' => 'required|string',
            'offer_letter'  => 'nullable|file|mimes:pdf,doc,docx',
        ]);
     
        $leadId = $request->input('lead_id');;
        $leadData = Lead::find($leadId);
        $interview_status = $leadData->interview_status;
        $isFollowup = $request->input('is_followup');
        $isFollowupStatus = ($isFollowup == 1) ? 20 : $leadData->interview_status;

        // Handle project closed
        $isProjectClosed = $request->has('is_project_closed') ? 1 : 0;
        $closeDate = $request->input('close_date');

        // Update the lead comment in the database
        $lead = Lead::findOrFail($request->input('lead_id'));
        $lead->lead_comment = $request->input('lead_comment');
        $lead->interview_status = $isFollowupStatus;
        $lead->follow_up_lead = $request->input('is_followup', 0);
        $lead->is_project_closed = $isProjectClosed;
        $lead->close_date = $isProjectClosed ? $closeDate : null;

        // Handle file upload if interview status is 5
        if ($interview_status == 5 && $request->hasFile('offer_letter')) {
            if (!file_exists(public_path('offer_letters'))) {
                mkdir(public_path('offer_letters'), 0777, true);
            }
            $file = $request->file('offer_letter');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('offer_letters'), $fileName);
            $lead->offer_letter_path = 'offer_letters/' . $fileName;
        }

        $lead->save();

        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        $userId = $user->user_id;
        $roleName = Role::find($user->role)->role_name;
        // Insert data into LeadHistory table
        $leadHistory = new LeadHistory();
        $leadHistory->lead_id = $request->input('lead_id');
        $leadHistory->comment = $request->input('lead_comment'); 
        $leadHistory->interview_status = $interview_status;
        $leadHistory->interview_status = ($isFollowup == 1) ? 20 : $interview_status;
        // Set the logged-in user's name and role
        $leadHistory->leadCreate_user_Id = $userId;
        $leadHistory->leadCreate_user_name = $userName;
        $leadHistory->leadCreate_user_role = $roleName;

        $leadHistory->save();
        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function LeadEndClientOrCompanyName(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'end_client_or_company_name' => 'required|string',
        ]);

        // Find the lead by its ID
        $lead = Lead::findOrFail($request->lead_id);

        // Update the end_client_or_company_name field
        $lead->end_client_or_company_name = $request->end_client_or_company_name;
        $lead->save();

        // Create a new end client or company name record
        LeadEndClientOrCompanyName::create([
            'lead_id' => $request->lead_id,
            'end_client_or_company_name' => $request->end_client_or_company_name
        ]);


        // Redirect back with a success message or do any other action as needed
        return redirect()->back()->with('success', 'End Client or Company Name updated successfully!');
    }

}
