<?php
namespace App\Http\Controllers\PerformanceDashboard;

use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use Carbon\Carbon;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Vendor;
use Illuminate\Support\Facades\Cache;

class ClosedLeadsViewController extends Controller
{
    public function getQuarterClosedLeads($year, $quarter)
    {
        switch ((int) $quarter) {
            case 1: $start = Carbon::create($year, 1, 1);  $end = Carbon::create($year, 3, 31)->endOfDay(); break;
            case 2: $start = Carbon::create($year, 4, 1);  $end = Carbon::create($year, 6, 30)->endOfDay(); break;
            case 3: $start = Carbon::create($year, 7, 1);  $end = Carbon::create($year, 9, 30)->endOfDay(); break;
            case 4: $start = Carbon::create($year, 10, 1); $end = Carbon::create($year, 12, 31)->endOfDay(); break;
            default: return response()->json(['error' => 'Invalid quarter'], 400);
        }

        // Build the query with required columns & relationships
        $leads = Lead::select(
                'id', 'company_id', 'technology_id',
                'vendor_id','close_date', 'is_project_closed',
                'lead_created_user_id', 'joining_date'
            )
            ->with([
                'company', 
                'vendor.technology',
                'createdUserLead', 
                'technology'
            ])
            ->where('is_project_closed', 1)
            ->whereNotNull('close_date')
            ->whereBetween('close_date', [$start->toDateString(), $end->toDateString()])
            ->get();

        return response()->json($leads);
    }
}
