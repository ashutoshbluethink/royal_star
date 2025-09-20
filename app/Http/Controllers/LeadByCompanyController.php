<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Lead\Lead;
use App\Models\User\User;
use App\Models\User\Role;
use App\Models\Company\Company;
use App\Models\Company\Technology;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Models\Lead\LeadStatus;
use App\Models\Lead\LeadHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\Vendor\Vendor;


class LeadByCompanyController extends Controller
{
    public function index(Request $request)
    {
        $companyId = $request->input('company_id');

        $leads = Lead::with(['company', 'vendor', 'vendor.technology','interviewer', 'createdUser', 'leadStatus'])
        ->where('company_id', $companyId)
        ->get();

        return response()->json($leads);
    }
}
