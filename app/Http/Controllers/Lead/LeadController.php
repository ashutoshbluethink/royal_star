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
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Cache;



class LeadController extends Controller
{
    public function showLeadForm()
    {
        $vendors = Vendor::with('technology')
        ->orderBy('name')
        ->get();

        $interviewee_users = User::select('users.*', 'roles.role_name')
        ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
        ->where('users.role', 3)
        ->where('users.user_status', 1)
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->where('leadstatusstatus', 'active')->get();
                
        $companies = Company::where('company_status', 1)->orderBy('company_name')->get();

        $technologies = Technology::where('technology_status', 1)->get();

        // added this new features on 30/07/2025 for sales team support user
        $leadSupportedUsers = User::select('users.*', 'roles.role_name')
        ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
        ->where('users.role', 8)
        ->orderBy('firstname')
        ->orderBy('lastname')
        ->get();
             
        return view('lead.add-lead', compact(
            'companies',
            'technologies',
            'vendors',
            'interviewee_users',
            'LeadStatuss',
            'leadSupportedUsers'

            ));
    }

    public function index()
    {
        $user = Auth::user();
        $loggedinUserId = $user->user_id;
        $loggedinUserRole = $user->role;

        // Fetch LeadStatuss directly without caching
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get(['leadstatusid', 'leadstatusname']);


        $leadsQuery = Lead::select(
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

        // if ($loggedinUserRole == 3) {
        //     // If user role is 3, filter by interviewee_id
        //     $leadsQuery->where('interviewee_id', $loggedinUserId);
        // }

        // Get paginated results
        // $leads = $leadsQuery->paginate(50); 
        $leads = $leadsQuery->get();
        
        $technologies = Technology:: where('technology_status', 1)->get(['technology_id', 'technology_name']);
        $vendors = Vendor::with('technology')->get(['vendor_id', 'name', 'technology_id']);

        
        return view('lead.view-lead', compact('leads', 'LeadStatuss', 'technologies', 'vendors'));
    }

    public function searchLeads(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $interviewStatus = $request->input('interview_status');
        $dateFilterType = $request->input('date_filter_type');
        $quarter = $request->input('quarter');
        $technologyId = $request->input('technology_id'); 
        $vendorId = $request->input('vendor_id'); // <-- new line

        $leadsQuery = Lead::select(
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

        $dateFormat = 'd-m-Y';
        if (!empty($fromDate) && !Carbon::createFromFormat($dateFormat, $fromDate)) {
            return redirect()->back()->with('message', 'We accept this date format: ' . $dateFormat)->withInput();
        }
        if (!empty($toDate) && !Carbon::createFromFormat($dateFormat, $toDate)) {
            return redirect()->back()->with('message', 'We accept this date format: ' . $dateFormat)->withInput();
        }

        if (!empty($fromDate) && empty($toDate)) {
            return redirect()->back()->with('message', 'Please select the to date.')->withInput();
        }
        if (!empty($toDate) && empty($fromDate)) {
            return redirect()->back()->with('message', 'Please select the from date.')->withInput();
        }

        if (!empty($fromDate) && !empty($toDate)) {
            $fromDateCarbon = Carbon::createFromFormat($dateFormat, $fromDate)->startOfDay();
            $toDateCarbon = Carbon::createFromFormat($dateFormat, $toDate)->endOfDay();

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
        if (!empty($vendorId)) { // <-- vendor filter
            $leadsQuery->where('vendor_id', $vendorId);
        }

        if (!empty($interviewStatus)) {
            $leadsQuery->where('interview_status', $interviewStatus);
        }

        $leads = $leadsQuery->get();
       

        $selectedValues = [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'quarter' => $quarter,
            'interview_status' => $interviewStatus,
            'date_filter_type' => $dateFilterType,
            'technology_id' => $technologyId,
            'vendor_id' => $vendorId,
        ];
        // technology search used 
        $technologies = DB::table('technologies')->where('technology_status', 1)->get();
        $vendors = Vendor::with('technology')->get(['vendor_id', 'name', 'technology_id']);
        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get();
        
        return view('lead.view-lead', compact('leads', 'LeadStatuss', 'selectedValues', 'technologies', 'vendors'));
    }
    
    public function indexc2c(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $interviewStatus = $request->input('interview_status');
        $dateFilterType = $request->input('date_filter_type');
        $quarter = $request->input('quarter');
        $salesUserId = $request->input('sales_user_id');

        $user = Auth::user();
        $loggedinUserId = $user->user_id;
        $loggedinUserRole = $user->role;

        $LeadStatuss = LeadStatus::where('leadstatusstatus', 1)->get(['leadstatusid', 'leadstatusname']);

        $leadsQuery = Lead::select(
            'id', 'company_id', 'technology_id', 'vendor_id',
            'interviewee_id', 'interview_date', 'interview_status',
            'lead_created_user_id', 'created_at', 'updated_at',
            'is_read', 'lead_comment', 'region', 'company_email', 
            'joining_date', 'lead_supported_by'
        )
        ->with([
        'companyLead', 
        'vendorLead', 'interviewerLead', 
        'createdUserLead', 
        'leadStatusLead',
        'leadSupportedBy'
        ])
        ->where('technology_id', 10); // Already filtered to tech ID 10

        $dateFormat = 'd-m-Y';

        if (!empty($fromDate) && !Carbon::createFromFormat($dateFormat, $fromDate)) {
            return redirect()->back()->with('message', 'We accept this date format: ' . $dateFormat)->withInput();
        }
        if (!empty($toDate) && !Carbon::createFromFormat($dateFormat, $toDate)) {
            return redirect()->back()->with('message', 'We accept this date format: ' . $dateFormat)->withInput();
        }
        if (!empty($fromDate) && empty($toDate)) {
            return redirect()->back()->with('message', 'Please select the to date.')->withInput();
        }
        if (!empty($toDate) && empty($fromDate)) {
            return redirect()->back()->with('message', 'Please select the from date.')->withInput();
        }

        if (!empty($fromDate) && !empty($toDate)) {
            $fromDateCarbon = Carbon::createFromFormat($dateFormat, $fromDate)->startOfDay();
            $toDateCarbon = Carbon::createFromFormat($dateFormat, $toDate)->endOfDay();

            $leadsQuery->where(function ($query) use ($fromDateCarbon, $toDateCarbon, $dateFilterType) {
                $query->whereNotNull('joining_date')
                    ->whereBetween(DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"), [$fromDateCarbon, $toDateCarbon])
                    ->orWhere(function ($q) use ($fromDateCarbon, $toDateCarbon, $dateFilterType) {
                        $q->whereNull('joining_date')
                            ->whereBetween($dateFilterType, [$fromDateCarbon, $toDateCarbon]);
                    });
            });
        }

        if (!empty($interviewStatus)) {
            $leadsQuery->where('interview_status', $interviewStatus);
        }
        if (!empty($salesUserId)) {
            $leadsQuery->where('lead_created_user_id', $salesUserId);
        }

        $leads = $leadsQuery->get();

        $selectedValues = [
            'from_date' => $fromDate,
            'to_date' => $toDate,
            'quarter' => $quarter,
            'interview_status' => $interviewStatus,
            'date_filter_type' => $dateFilterType,
            'sales_user_id' => $salesUserId,

        ];
        $salesTeam = DB::table('users')
            ->where('role', '4')
            ->where('user_status', 1)
            ->get();


        return view('lead.view-lead-c2c', compact(
            'leads', 
            'LeadStatuss', 
            'selectedValues',
            'salesTeam'
        ));
    }

    public function updateReadStatus(Request $request, Lead $lead)
    {
        $lead->update(['is_read' => $request->is_read]);
        return response()->json(['success' => true]);
    }
    
  
}
