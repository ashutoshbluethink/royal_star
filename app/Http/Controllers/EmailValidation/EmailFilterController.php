<?php

namespace App\Http\Controllers\EmailValidation;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\EmailValidation\ValidEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\EmailValidation\EmailFilter;


class EmailFilterController extends Controller
{


    public function showConfig()
    {
        $filters = EmailFilter::all(); // Get all the filters from the database
        return view('emailvalidation.email-config', compact('filters'));
    }

    public function store(Request $request)
    {
        // Validate that the input is a string
        $request->validate([
            'filter_value' => 'required|string|max:255',
        ]);
    
        // Split the input by commas and trim any spaces
        $filters = array_map('trim', explode(',', $request->filter_value));
    
        // Loop through each filter and create a new record if it's not empty
        foreach ($filters as $filter) {
            if (!empty($filter)) {
                EmailFilter::create([
                    'filter_value' => $filter,
                ]);
            }
        }
    
        return redirect()->route('email.config')->with('success', 'Filters added successfully.');
    }
    

    public function destroy($id)
    {
        $filter = EmailFilter::find($id);

        if ($filter) {
            $filter->delete();
            return redirect()->route('email.config')->with('success', 'Filter removed successfully.');
        }

        return redirect()->route('email.config')->with('error', 'Filter not found.');
    }
    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'filter_value' => 'required|string|max:255',
        ]);
    
        // Find the filter by ID and update it
        $filter = EmailFilter::findOrFail($id);
        $filter->filter_value = $request->input('filter_value');
        $filter->save();
    
        // Redirect back with a success message
        return redirect()->route('email.config')->with('success', 'Filter updated successfully.');
    }
    
     
}
