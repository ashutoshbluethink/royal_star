<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead\Lead;
use App\Models\User\User;
use App\Models\Lead\LeadStatus;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class LeadUserController extends Controller
{
    public function show($userId)
    {
        $today = Carbon::today()->toDateString(); 

        // Find the user by ID Sales Team
        $userLeadcreators = User::findOrFail($userId);
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();

        /*
        |--------------------------------------------------------------------------
        |  This is applied for the Interview they not see other user data form the url 
        |--------------------------------------------------------------------------
        */
        $current_user = Auth::user();
        if($current_user->role == 3){

            $userId = $current_user->user_id;
            $userLeadcreators = User::findOrFail($userId);

        }
        /*
        |--------------------------------------------------------------------------
        |  For Sales Team
        |--------------------------------------------------------------------------
        */
        if($userLeadcreators->role == 4){
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus', 'leadSupportedBy'])
            ->where('lead_created_user_id', $userId)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | lead supported Team
        |--------------------------------------------------------------------------
        */
        }elseif ($userLeadcreators->role == 8) {  
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus', 'leadSupportedBy'])
            ->where('lead_supported_by', $userId)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Interviee Team
        |--------------------------------------------------------------------------
        */
        }elseif ($userLeadcreators->role == 3) {  
            $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus', 'leadSupportedBy'])
            ->where('interviewee_id', $userId)
            ->get();
        }
        /*
        |--------------------------------------------------------------------------
        | For Adminstator
        |--------------------------------------------------------------------------
        */
         else {
            $leads = Lead::with(['company', 'vendor', 
            'interviewer', 'createdUser', 
            'technology', 'leadStatus'
            ])
            ->where('lead_created_user_id', $userId)
            ->get();

        }
        
        // technology search used 
        $technologies = DB::table('technologies')
        ->where('technology_status', 1)
        ->get();

        return view('user.lead_user', compact(
            'userLeadcreators', 
            'leads', 
            'LeadStatuss',
            'technologies'
        ));
    }
    public function UserFilterLeads(Request $request, $searchuserId)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $interviewStatus = $request->input('interview_status');
        $dateFilterType = $request->input('date_filter_type');
        $quarter = $request->input('quarter');
        $technologyId = $request->input('technology_id'); // <-- new line

        // $selectedValues = [];
        $userLeadcreators = User::findOrFail($searchuserId);
        $userLeadcreatorsRoleId = $userLeadcreators->role;

        if ($userLeadcreatorsRoleId == 3) {
            $leadsQuery = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
                ->where('interviewee_id', $searchuserId);
        } elseif ($userLeadcreatorsRoleId == 8) {
            $leadsQuery = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
                ->where('lead_supported_by', $searchuserId);
        } else {
            $leadsQuery = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
                ->where('lead_created_user_id', $searchuserId);
        }


        if (!empty($fromDate) && empty($toDate)) {
            return redirect()->back()->with('message', 'Please select the to date.')->withInput();
        }
        if (!empty($toDate) && empty($fromDate)) {
            return redirect()->back()->with('message', 'Please select the from date.')->withInput();
        }

        if (!empty($fromDate) && !empty($toDate)) {
            $fromDateCarbon = Carbon::createFromFormat('d-m-Y', $fromDate)->startOfDay();
            $toDateCarbon = Carbon::createFromFormat('d-m-Y', $toDate)->endOfDay();

            $leadsQuery->where(function ($query) use ($fromDateCarbon, $toDateCarbon, $dateFilterType) {
                $query->whereNotNull('joining_date')
                    ->whereBetween(DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"), [$fromDateCarbon, $toDateCarbon])
                    ->orWhere(function ($q) use ($fromDateCarbon, $toDateCarbon, $dateFilterType) {
                        $q->whereNull('joining_date')
                        ->whereBetween($dateFilterType, [$fromDateCarbon, $toDateCarbon]);
                    });
            });


        }

        if (!empty($technologyId)) {
            $leadsQuery->where('technology_id', $technologyId); // <-- apply tech filter
        }

        if (!empty($interviewStatus)) {
            $leadsQuery->where('interview_status', $interviewStatus);
        }

        $leads = $leadsQuery->get();

        // return the blade file leadstatusstatus on top
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();

        $selectedValues = [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'quarter' => $quarter,
            'interview_status' => $interviewStatus,
            'date_filter_type' => $dateFilterType,
            'technology_id' => $technologyId,
        ];

        // technology search used 
        $technologies = DB::table('technologies')
        ->where('technology_status', 1)
        ->get();

        return view('user.lead_user', compact(
            'leads', 
            'LeadStatuss', 
            'selectedValues', 
            'userLeadcreators',
            'technologies'
        ));
    }
    
}
