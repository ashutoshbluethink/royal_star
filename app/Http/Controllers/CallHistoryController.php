<?php

// app/Http/Controllers/CallHistoryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallHistory\CallHistory;
use App\Models\CallHistory\CallHistoryDetail;
use App\Models\Company\Technology;
use Illuminate\Support\Facades\Auth;

class CallHistoryController extends Controller
{
    public function show()
    {
        // Fetch technologies
        $technologies = Technology::where('technology_status', 1)->get();
        
        // Initialize callHistories variable
        $callHistories = [];
    
        // Check if the user is authenticated
        if(auth()->check()) {
            // Get the user ID
            $user_id = auth()->user()->user_id;
    
            // Check if the logged-in user's role is 3
            if(auth()->user()->role == 3) {
                // Fetch call histories where created_by_user_id is the user's ID
                $callHistories = CallHistory::with('technology')
                    ->where('created_by_user_id', $user_id)
                    ->get();
            } else {
                // Fetch all call histories
                $callHistories = CallHistory::with('technology')->get();
            }
        }
    
        // Pass data to the view
        return view('callhistories.show', compact('callHistories', 'technologies'));
    }
    

    public function index()
    {

        $technologies = Technology::where('technology_status', 1)->get();
        $callHistories = CallHistory::with('technology')->get();

        return view('callhistories.index', compact('callHistories' ,'technologies'));
    }

    public function viewCallDetails($id)
    {
        // Retrieve the call history by ID
        $callHistory = CallHistory::findOrFail($id);

        // Retrieve the call history details where call_history_id matches $id
        $callHistoryDetails = CallHistoryDetail::where('call_history_id', $id)->get();

        // You can pass the $callHistory and $callHistoryDetails data to a view and render it there
        // For example:
        return view('callhistories.details', [
            'callHistory' => $callHistory,
            'callHistoryDetails' => $callHistoryDetails
        ]);
    }

    public function store(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        $user_id = $user->user_id;
        // Extract mobile_no and technology_id from the request
        $mobileNo = $request->input('mobile_no');
        $technologyId = $request->input('technology_id');
    
        // Check if the combination of mobile_no and technology_id exists in call_histories
        $callHistory = CallHistory::where('mobile_no', $mobileNo)
            ->where('technology_id', $technologyId)
            ->first();
    
        if ($callHistory) {
            // If the combination already exists, insert data into call_history_details
            $callHistoryDetailsData = [
                'call_history_id' => $callHistory->id,
                'comment' => $request->input('comment'),
                'created_by' => $userName,
            ];
    
            CallHistoryDetail::create($callHistoryDetailsData);
        } else {
            // If the combination doesn't exist, insert data into call_histories first
            $callHistoryData = [
                'mobile_no' => $mobileNo,
                'technology_id' => $technologyId,
                'comment' => $request->input('comment'),
                'created_by' => $userName,
                'company_name' => $request->input('company_name'),
                'hr_name' => $request->input('hr_name'),
                'created_by_user_id' => $user_id
            ];
    
            $callHistory = CallHistory::create($callHistoryData);
    
            // Insert data into call_history_details
            $callHistoryDetailsData = [
                'call_history_id' => $callHistory->id,
                'comment' => $request->input('comment'),
                'created_by' => $userName
            ];
    
            CallHistoryDetail::create($callHistoryDetailsData);
        }
    
        // Redirect with success message
        return redirect()->route('callhistory.index')->with('success', 'Call history created successfully.');
    }
    
    public function edit($id)
    {
        $technologies = Technology::where('technology_status', 1)->get();
        $callHistories = CallHistory::with('technology')->get();

        $callHistory = CallHistory::findOrFail($id);
        return view('callhistories.edit', compact('callHistory', 'callHistories', 'technologies'));
    }

    public function update(Request $request, $id)
    {
        // Get the authenticated user
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
        
        // Find the CallHistory record by ID
        $callHistory = CallHistory::findOrFail($id);
    
        // Prepare data for CallHistory update
        $requestData = $request->all();
        
        // Update attributes
        $requestData['created_by'] = $userName;
        
        // Update the CallHistory record
        $callHistory->update($requestData);
    
        // Redirect with success message
        return redirect()->route('callhistory.index')->with('success', 'Call history updated successfully.');
    }
    

    public function destroy($id)
    {
        $callHistory = CallHistory::findOrFail($id);
        $callHistory->delete();
        return redirect()->route('callhistory.show')->with('success', 'Call history deleted successfully.');
    }


    public function saveComment(Request $request)
    {
        // Get the authenticated user
        $user = Auth::user();
        $userName = $user->firstname . ' ' . $user->lastname;
    
        // Retrieve call history ID and comment from the request
        $callHistoryId = $request->input('callHistory_id');
        $comment = $request->input('comment');
    
        // Create an array with the call history details data
        $callHistoryDetailsData = [
            'call_history_id' => $callHistoryId,
            'comment' => $comment,
            'created_by' => $userName
        ];
    
        // Create a new CallHistoryDetail instance and save it to the database
        CallHistoryDetail::create($callHistoryDetailsData);
    
        // Redirect the user to the view call details route with a success message
        return redirect()->route('callhistory.viewCallDetails', ['id' => $callHistoryId])->with('success', 'Comment added successfully.');
    }
    
}

