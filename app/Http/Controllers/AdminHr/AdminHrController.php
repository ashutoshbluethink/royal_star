<?php

namespace App\Http\Controllers\AdminHr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class AdminHrController extends Controller
{
    public function joiningForm()
    {
        //$companies = Company::all();
        return view('adminhr.joiningform');
    }

    public function consultancyForm()
    {
        //$companies = Company::all();
        return view('adminhr.consultancyform');
    }

    public function employeHistoryForm()
    {
        //$companies = Company::all();
        return view('adminhr.employe-history-form');
    }


}