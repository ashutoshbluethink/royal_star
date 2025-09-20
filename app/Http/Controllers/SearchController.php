<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // $leads = Lead::select(
        //     'leads.*',
        //     'leads.created_at as lead_created_at',
        //     'companies.*',
        //     'users.firstname as candidate_firstname',
        //     'users.lastname as candidate_lastname',
        //     'users.role as candidate_role',
        //     'interviewers.firstname as interviewer_firstname',
        //     'interviewers.lastname as interviewer_lastname'
        // )
        // ->leftJoin('companies', 'leads.company_id', '=', 'companies.company_id')
        // ->leftJoin('users', 'leads.candidate_id', '=', 'users.user_id')
        // ->leftJoin('users as interviewers', 'leads.interviewee_id', '=', 'interviewers.user_id')
        // ->where(function($queryBuilder) use ($query) {
        //     $queryBuilder->where('companies.company_name', 'like', "%{$query}%")
        //                  ->orWhere(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'like', "%{$query}%")
        //                  ->orWhere(DB::raw("CONCAT(interviewers.firstname, ' ', interviewers.lastname)"), 'like', "%{$query}%");
        // })
        // ->get();
        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])->get();
        // $leads = Lead::select(
        //     'leads.*',
        //     'leads.created_at as lead_created_at',
        //     'companies.*',
        //     'vendors.firstname as candidate_firstname',
        //     'users.role as candidate_role',
        //     'interviewers.firstname as interviewer_firstname',
        //     'interviewers.lastname as interviewer_lastname',
        //     'lead_statuses.leadstatusname as lead_status'
        // )
        // ->leftJoin('companies', 'leads.company_id', '=', 'companies.company_id')
        // ->leftJoin('users', 'leads.candidate_id', '=', 'users.user_id')
        // ->leftJoin('users as interviewers', 'leads.interviewee_id', '=', 'interviewers.user_id')
        // ->leftJoin('lead_statuses', 'leads.interview_status', '=', 'lead_statuses.leadstatusid')
        // ->where(function($queryBuilder) use ($query) {
        //     $queryBuilder->where('companies.company_name', 'like', "%{$query}%")
        //                  ->orWhere(DB::raw("CONCAT(users.firstname, ' ', users.lastname)"), 'like', "%{$query}%")
        //                  ->orWhere(DB::raw("CONCAT(interviewers.firstname, ' ', interviewers.lastname)"), 'like', "%{$query}%");
        // })
        // ->get();

        $leads = Lead::select(
            'leads.*',
            'leads.created_at as lead_created_at',
            'companies.*',
            'vendors.*',
            'technologies.technology_name', // Add the technology_name column
            'interviewers.firstname as interviewer_firstname',
            'interviewers.lastname as interviewer_lastname',
            'lead_statuses.leadstatusname as lead_status'
        )
        ->leftJoin('companies', 'leads.company_id', '=', 'companies.company_id')
        ->leftJoin('vendors', 'leads.vendor_id', '=', 'vendors.vendor_id')
        ->leftJoin('users as interviewers', 'leads.interviewee_id', '=', 'interviewers.user_id')
        ->leftJoin('lead_statuses', 'leads.interview_status', '=', 'lead_statuses.leadstatusid')
        ->leftJoin('technologies', 'vendors.technology_id', '=', 'technologies.technology_id') // Join with the technologies table
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('companies.company_name', 'like', "%{$query}%")
                         ->orWhere(DB::raw("CONCAT(vendors.name, ')')"), 'like', "%{$query}%")
                         ->orWhere(DB::raw("CONCAT(interviewers.firstname, ' ', interviewers.lastname)"), 'like', "%{$query}%");
        })
        ->get();
        
        
        

        if ($leads->isEmpty()) {
            return response()->json(['message' => 'No records found']);
        }

        return response()->json($leads);
    }
}
