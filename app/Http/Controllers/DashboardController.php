<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Lead\Lead;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\User\Role;
use App\Services\PerformanceDashboard\TeamTargetAchievementService;

class DashboardController extends Controller
{
    protected $teamTargetService;


    public function __construct(
        TeamTargetAchievementService $teamTargetService
        
    ) {
        $this->teamTargetService = $teamTargetService;       
    }

    public function index()
    {
        $today = Carbon::today();
        $firstDayOfMonth = Carbon::now()->startOfMonth();

        /*
        |--------------------------------------------------------------------------
        | Sales Team (Role ID: 4)
        |--------------------------------------------------------------------------
        */
        $salesTeamUsers = User::where('role', 4)
            ->select('user_id', 'firstname', 'lastname', 'role', 'user_image')
            ->get();

        foreach ($salesTeamUsers as $user) {
            $user->todayLeadCount = Lead::where('lead_created_user_id', $user->user_id)
                ->whereDate('created_at', $today)
                ->count();

            $user->monthLeadCount = Lead::where('lead_created_user_id', $user->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | Email Extractor Team (Role ID: 6)
        |--------------------------------------------------------------------------
        */
        $emailExtractors = User::where('role', 6)
            ->select('user_id', 'firstname', 'lastname', 'role', 'user_image')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Lead Support Team (Role ID: 8)
        |--------------------------------------------------------------------------
        */
        $leadSupportUsers = User::where('role', 8)
            ->select('user_id', 'firstname', 'lastname', 'role', 'user_image')
            ->get();

        foreach ($leadSupportUsers as $user) {
            $user->todayLeadCount = Lead::where('lead_supported_by', $user->user_id)
                ->whereDate('created_at', $today)
                ->count();

            $user->monthLeadCount = Lead::where('lead_supported_by', $user->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | Interviewers (Role ID: 3)
        |--------------------------------------------------------------------------
        */
        $interviewers = User::where('role', 3)
            ->select('user_id', 'firstname', 'lastname', 'role', 'user_image')
            ->get();

        foreach ($interviewers as $user) {
            $user->todayInterviewCount = Lead::where('interviewee_id', $user->user_id)
                ->whereDate('interview_date', $today)
                ->count();

            $user->monthLeadCount = Lead::where('interviewee_id', $user->user_id)
                ->where('created_at', '>=', $firstDayOfMonth)
                ->count();
        }

        /*
        |--------------------------------------------------------------------------
        | All Leads (with Interviewer Relationship)
        |--------------------------------------------------------------------------
        */
        // $allLeads = Lead::with(['interviewer'])->get();

        /*
        |--------------------------------------------------------------------------
        | Lead Status Breakdown
        |--------------------------------------------------------------------------
        */
        $leadStatusCounts = Lead::select(
                'lead_statuses.leadstatusid',
                'lead_statuses.leadstatusname',
                DB::raw('COUNT(leads.id) as total')
            )
            ->join('lead_statuses', 'leads.interview_status', '=', 'lead_statuses.leadstatusid')
            ->groupBy('lead_statuses.leadstatusid', 'lead_statuses.leadstatusname')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Count of Upcoming Joinings (Onboarding)
        |--------------------------------------------------------------------------
        */
        $upcomingOnboardingCount = Lead::where(
                DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"),
                '>',
                Carbon::today()
            )->count();

        /*
        |--------------------------------------------------------------------------
        | Pass Data to Dashboard View
        |--------------------------------------------------------------------------
        */
        $currentYear = Carbon::now()->year;
        $targetsByQuarter = $this->teamTargetService->getTeamWiseTargetsByQuarter($currentYear);

 

        return view('dashboard', compact(
            'salesTeamUsers',
            'interviewers',
            // 'allLeads',
            'leadStatusCounts',
            'emailExtractors',
            'upcomingOnboardingCount',
            'leadSupportUsers',
            'currentYear',
            'targetsByQuarter'
        ));
    }
}
