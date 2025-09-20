<?php

namespace App\Http\Controllers\live_interviews;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Cache;

class InterviewController extends Controller
{    
    public function index()
    {
        // Get the current date and the date for the next two days
        $today = Carbon::today();
        $twoDaysLater = Carbon::today()->addDays(2);

        $today = Carbon::now('Asia/Kolkata'); // Get the current date and time in IST

        // Get the current date & time in IST
        $now = Carbon::now('Asia/Kolkata');
    
        // Get the threshold time (current time - 15 minutes)
        $timeMinus15 = $now->copy()->subMinutes(15);

        // Fetch the leads with relationships and group by technology
        $leads = Lead::select(
                'id',
                'company_id',
                'vendor_id',
                'interviewee_id',
                'interview_date',
                'interview_time',
                'interview_status',
                'lead_created_user_id',     
                'lead_comment'
            )
            ->with([
                'vendorLead.technology',
                'interviewerLead',
                'createdUserLead',
                'leadStatusLead',
                'leadHistories'
            ])
            ->whereNotNull('interview_time') 
            ->where('interview_time', '!=', '')
            ->whereDate('interview_date', '>=', $today) 
            ->whereDate('interview_date', '<=', $twoDaysLater) 
        
            ->where(function ($query) use ($now, $timeMinus15) {
                // Convert interview_date + interview_time into a DateTime object and compare
                $query->whereRaw("
                    STR_TO_DATE(CONCAT(DATE(interview_date), ' ', interview_time), '%Y-%m-%d %h:%i %p') >= ?", 
                    [$timeMinus15]
                );
            })
            ->orderBy('interview_date', 'asc')
            ->get();

        // Group leads by technology name
        $groupedLeads = $leads->groupBy(function ($lead) {
            return $lead->vendorLead->technology->technology_name ?? 'Unknown Technology';
        });
        return view('live_interviews.live-interview-scheduled', compact('groupedLeads'));
    }
}
