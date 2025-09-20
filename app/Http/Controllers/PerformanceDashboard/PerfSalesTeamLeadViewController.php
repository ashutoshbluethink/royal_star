<?php

namespace App\Http\Controllers\PerformanceDashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead\Lead;
use App\Models\User\User;
use Carbon\Carbon;
use App\Models\Company\Technology;

class PerfSalesTeamLeadViewController extends Controller
{
    /**
     * Display quarter-wise leads for a specific sales member.
     */
    public function showPerformanceSalesTeamLead(Request $request)
    {
        $userId = $request->query('user_id');
        $quarter = strtoupper($request->query('quarter'));
        $year = $request->query('year');
        $interviwee_id = $request->query('interviwee_id');
        $technology_id = $request->query('technology_id'); // Add this line


        if (!$quarter || !$year) {
            return redirect()->back()->with('error', 'Missing required parameters.');
        }
        // Determine quarter start and end
        switch ($quarter) {
            case 'Q1':
                $start = Carbon::create($year, 1, 1);
                $end = Carbon::create($year, 3, 31)->endOfDay();
                break;
            case 'Q2':
                $start = Carbon::create($year, 4, 1);
                $end = Carbon::create($year, 6, 30)->endOfDay();
                break;
            case 'Q3':
                $start = Carbon::create($year, 7, 1);
                $end = Carbon::create($year, 9, 30)->endOfDay();
                break;
            case 'Q4':
                $start = Carbon::create($year, 10, 1);
                $end = Carbon::create($year, 12, 31)->endOfDay();
                break;
            default:
            return redirect()->back()->with('error', 'Invalid quarter.');
        }


        // Build query
        $query = Lead::select(
            'id', 'company_id', 'technology_id', 'vendor_id', 'interviewee_id',
            'interview_date', 'interview_status', 'lead_created_user_id',
            'created_at', 'updated_at', 'is_read', 'lead_comment',
            'region', 'company_email', 'joining_date', 'lead_supported_by'
        )
        ->with([
            'companyLead',
            'vendorLead',
            'interviewerLead',
            'createdUserLead',
            'leadStatusLead',
            'leadSupportedBy'
        ]);
        $technology=null;
        if ($interviwee_id) {
            $memberuser = User::where('user_id', $interviwee_id)->firstOrFail();
            $query->where('interviewee_id', $interviwee_id);
        } else if ($userId) {
            $memberuser = User::where('user_id', $userId)->firstOrFail();
            $query->where('lead_created_user_id', $userId);
        } else if ($technology_id) {
            $memberuser=null;
            $technology = Technology::where('technology_id', $technology_id)->first();
            $query->where('technology_id', $technology_id);
        }


        // Interview status filter
        $leads = $query->where('interview_status', 5)->get();

        // Filter by joining date within quarter
        $filteredLeads = $leads->filter(function ($lead) use ($start, $end) {
            if (empty($lead->joining_date)) {
                return false;
            }

            try {
                $joining = Carbon::createFromFormat('d-m-Y', $lead->joining_date);
                return $joining->between($start, $end);
            } catch (\Exception $e) {
                return false;
            }
        });

        // Sort by joining date
        $sortedLeads = $filteredLeads->sortBy(function ($lead) {
            return Carbon::createFromFormat('d-m-Y', $lead->joining_date);
        });

        return view('performancedashboard.PerformanceQuaterView.performanceQuaterView', [
            'leads' => $sortedLeads,
            'memberuser' => $memberuser,
            'quarter' => $quarter,
            'year' => $year,
            'technology' => $technology,
        ]);
    }
}
