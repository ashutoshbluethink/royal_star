<?php

namespace App\Http\Controllers\PerformanceDashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use Illuminate\Support\Facades\DB;

class RunningProjectsByVendorController extends Controller
{
    public function index()
    {
        // Fetch running projects grouped by vendor_id and technology_id, ordered by vendor name
        $runningProjects = Lead::where('is_project_closed', 0)
            ->whereNotNull('joining_date')
            ->join('vendors', 'leads.vendor_id', '=', 'vendors.vendor_id') 
            ->leftJoin('technologies', 'leads.technology_id', '=', 'technologies.technology_id')
            ->select(
                'leads.vendor_id',
                'leads.technology_id',
                'vendors.name as vendor_name',
                'technologies.technology_name',
                DB::raw('COUNT(leads.id) as total_running')
            )
            ->groupBy('leads.vendor_id', 'leads.technology_id', 'vendors.name', 'technologies.technology_name')
            ->orderBy('vendors.name', 'asc')
            ->get();



                // Calculate total running projects
                $totalRunning = $runningProjects->sum('total_running');

                return view('performancedashboard.running_projects_vendors', compact('runningProjects', 'totalRunning'));
            }

    public function show($vendorId)
    {

        $projects = Lead::select(
                'id', 'company_id', 'technology_id',
                'vendor_id','close_date', 'is_project_closed',
                'lead_created_user_id', 'joining_date' ,'interviewee_id'
            )
            ->with([
                'company', 
                // 'vendor.technology',
                'createdUserLead', 
                'technology',
                'interviewerLead', 
            ])
            ->where('vendor_id', $vendorId)
        ->where('is_project_closed', 0)
        ->whereNotNull('joining_date')
            ->orderBy('leads.created_at', 'desc')
            ->get();

        return response()->json($projects);
    }

}
