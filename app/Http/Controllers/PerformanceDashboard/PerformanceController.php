<?php

namespace App\Http\Controllers\PerformanceDashboard;

use App\Http\Controllers\Controller;
use App\Models\User\User;
use App\Models\PerformanceDashboard\CreateTargetModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Services\PerformanceDashboard\TeamTargetAchievementService;
use App\Services\PerformanceDashboard\SalesMemberService;
use App\Services\PerformanceDashboard\InterviewMemberService;
use App\Services\PerformanceDashboard\TechnologyQuarterCountService;
use App\Services\PerformanceDashboard\ClosedLeadsService;
use App\Models\Company\Technology;
use App\Models\Lead\Lead;

// class PerformanceController extends Controller
// {
//     protected $salesService;
//     protected $teamTargetService;
//     protected $interviewService;
   

//     public function __construct(
//         SalesMemberService $salesService,
//         TeamTargetAchievementService $teamTargetService,
//         InterviewMemberService $interviewService
        
//     ) {
//         $this->salesService = $salesService;
//         $this->teamTargetService = $teamTargetService;
//         $this->interviewService = $interviewService;
       
//     }

//     public function index(Request $request)
//     {
//         $currentYear = Carbon::now()->year;

//         $salesMembers = $this->salesService->getSalesMembersWithQuarterCounts($currentYear);
//         $targetsByQuarter = $this->teamTargetService->getTeamWiseTargetsByQuarter($currentYear);
//         $interviewMembers = $this->interviewService->getInterviewMembersWithQuarterCounts($currentYear);

//     $technologies = Technology::where('technology_status', 1)->get();

//     $technologiesQuarterCounts = [];

//     foreach ($technologies as $tech) {
//         $counts = [];
//         for ($q = 1; $q <= 4; $q++) {
//             $start = Carbon::create($currentYear, ($q-1)*3 + 1, 1)->startOfMonth();
//             $end = (clone $start)->addMonths(2)->endOfMonth();

//             // joining_date is in d-m-Y, so use MySQL STR_TO_DATE to convert string to date for comparison
//             $counts['q' . $q] = Lead::where('technology_id', $tech->technology_id)
//                 ->whereNotNull('joining_date')
//                 ->whereBetween(
//                     DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"),
//                     [$start->toDateString(), $end->toDateString()]
//                 )
//                  ->where('interview_status', 5)
//                 ->count();
//         }
//         $technologiesQuarterCounts[$tech->technology_id] = $counts;

//         $closedLeadsQuarterCounts = [];
//         for ($q = 1; $q <= 4; $q++) {
//             $start = Carbon::create($currentYear, ($q - 1) * 3 + 1, 1)->startOfMonth();
//             $end = (clone $start)->addMonths(2)->endOfMonth();

//             $closedLeadsQuarterCounts['q' . $q] = Lead::where('is_project_closed', 1)
//                 ->whereNotNull('close_date')
//                 ->whereBetween('close_date', [$start->toDateString(), $end->toDateString()])
//                 ->count();
//         }

    

//     }
//         return view('performancedashboard.Performancedashboard', compact(
//             'currentYear',
//             'salesMembers',
//             'interviewMembers',
//             'targetsByQuarter',
//             'technologies',
//             'technologiesQuarterCounts',
//             'closedLeadsQuarterCounts'
//         ));
//     }
// }


class PerformanceController extends Controller
{
    protected $salesService;
    protected $teamTargetService;
    protected $interviewService;
    protected $techQuarterService;
    protected $closedLeadsService;

    public function __construct(
        SalesMemberService $salesService,
        TeamTargetAchievementService $teamTargetService,
        InterviewMemberService $interviewService,
        TechnologyQuarterCountService $techQuarterService,
        ClosedLeadsService $closedLeadsService
    ) {
        $this->salesService = $salesService;
        $this->teamTargetService = $teamTargetService;
        $this->interviewService = $interviewService;
        $this->techQuarterService = $techQuarterService;
        $this->closedLeadsService = $closedLeadsService;
    }

    public function index(Request $request)
    {
        $currentYear = Carbon::now()->year;

        $salesMembers = $this->salesService->getSalesMembersWithQuarterCounts($currentYear);
        $targetsByQuarter = $this->teamTargetService->getTeamWiseTargetsByQuarter($currentYear);
        $interviewMembers = $this->interviewService->getInterviewMembersWithQuarterCounts($currentYear);

        $techData = $this->techQuarterService->getTechnologiesQuarterCounts($currentYear);
        $technologies = $techData['technologies'];
        $technologiesQuarterCounts = $techData['technologiesQuarterCounts'];

        $closedLeadsQuarterCounts = $this->closedLeadsService->getClosedLeadsQuarterCounts($currentYear);

        return view('performancedashboard.Performancedashboard', compact(
            'currentYear',
            'salesMembers',
            'interviewMembers',
            'targetsByQuarter',
            'technologies',
            'technologiesQuarterCounts',
            'closedLeadsQuarterCounts'
        ));
    }
}
