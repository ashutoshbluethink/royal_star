<?php
namespace App\Http\Controllers\Lead;
use Illuminate\Pagination\Paginator;


use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use Illuminate\Http\Request;
use App\Models\User\User;
use Carbon\Carbon;
use App\Models\Lead\LeadStatus; 

class LeadStatusBaseRecordController extends Controller
{

    public function StatusBaseRecordShow($id, Request $request)
    {
        $user_id = $request->query('user_id');
        $technologyId = $request->query('technology_id');
        $vendorId = $request->query('vendor_id'); // ✅ added vendor
        $fromDate = $request->query('from_date');
        $toDate = $request->query('to_date');
        $dateFilterType = $request->query('date_filter_type', 'updated_at'); // 'created_at' or 'updated_at'

        $LeadstatusNameById = LeadStatus::find($id);

        $leadsQuery = Lead::with([
            'company',
            'vendor',
            'interviewer',
            'createdUser',
            'technology',
            'leadStatus'
        ])->where('interview_status', $id);

        $user_detail = null;

        if ($user_id) {
            $user_detail = User::findOrFail($user_id);
            $user_detail_role = $user_detail->role;

            if ($user_detail_role == 3) {
                $leadsQuery->where('interviewee_id', $user_id);
            } elseif ($user_detail_role == 8) {
                $leadsQuery->where('lead_supported_by', $user_id);
            } else {
                $leadsQuery->where('lead_created_user_id', $user_id);
            }
        }

        if ($technologyId) {
            $leadsQuery->where('technology_id', $technologyId);
        }

        if ($vendorId) { // ✅ filter by vendor
            $leadsQuery->where('vendor_id', $vendorId);
        }
        
        $leads = collect();

        // Special case: Status 5 = filter by joining_date
        if ($id == 5 && $fromDate && $toDate) {
            try {
                $from = Carbon::createFromFormat('d-m-Y', $fromDate);
                $to = Carbon::createFromFormat('d-m-Y', $toDate);

                $allLeads = $leadsQuery->get();

                $leads = $allLeads->filter(function ($lead) use ($from, $to) {
                    if (!$lead->joining_date) return false;

                    try {
                        $joining = Carbon::createFromFormat('d-m-Y', $lead->joining_date);
                        return $joining->between($from, $to);
                    } catch (\Exception $e) {
                        return false;
                    }
                })->values();

                $perPage = 10;
                $currentPage = request()->get('page', 1);
                $pagedLeads = new \Illuminate\Pagination\LengthAwarePaginator(
                    $leads->forPage($currentPage, $perPage),
                    $leads->count(),
                    $perPage,
                    $currentPage,
                    ['path' => url()->current(), 'query' => request()->query()]
                );

                $leads = $pagedLeads;
            } catch (\Exception $e) {
                // Log error if needed
            }
        } else {
            // Normal case: filter by created_at or updated_at (dynamic)
            if ($fromDate && $toDate) {
                try {
                    $from = Carbon::createFromFormat('d-m-Y', $fromDate)->startOfDay();
                    $to = Carbon::createFromFormat('d-m-Y', $toDate)->endOfDay();

                    // Ensure filter field is valid
                    if (in_array($dateFilterType, ['created_at', 'updated_at'])) {
                        $leadsQuery->whereBetween($dateFilterType, [$from, $to]);
                    }
                } catch (\Exception $e) {
                    // Log error if needed
                }
            }

            $leads = $leadsQuery->orderBy($dateFilterType, 'desc')->paginate(10);
        }

        $data = [
            'leads' => $leads,
            'LeadstatusNameById' => $LeadstatusNameById,
        ];

        if ($user_detail) {
            $data['user_detail'] = $user_detail;
        }

        return view('lead.leadstatus_filterRecord', $data);
    }


    public function UpcomingOnboardingProjectList(Request $request)
    {
        $leads = Lead::with(['company', 'vendor', 'interviewer', 'createdUser', 'technology', 'leadStatus'])
        ->whereRaw("STR_TO_DATE(joining_date, '%d-%m-%Y') >= ?", [Carbon::today()->format('Y-m-d')]) // Compare the date
        ->paginate(10);

        return view('lead.UpcomingOnboardingProjectList', compact('leads'));
    }

}
