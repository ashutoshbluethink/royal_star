<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Company;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{
    public function companyList()
    {
        $companies = Company::all();
        return view('company.addCompany', compact('companies'));
    }

    public function companyNameAdd(Request $request)
    {
        $validatedData = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_image' => 'nullable|image|max:1024',
            'company_status' => 'nullable', 
        ]);
        
        // Determine if it's an update or an addition
        if ($request->has('company_id')) {
            // Update the existing company
            $company = Company::find($request->company_id);
            if (!$company) {
                return redirect()->route('add.company')->with('error', 'Company not found.');
            }
    
            // Update company name if provided
            $company->company_name = $validatedData['company_name'];
            $company->company_status = $validatedData['company_status'];
    
            // Update company image if provided
            if ($request->hasFile('company_image')) {
                // Delete old image if it exists
                   if ($company->company_image) {
                        Storage::disk('public')->delete($company->company_image);
                    }
    
                // Upload and store new image
                $imagePath = $request->file('company_image')->store('company_logo', 'public');
                if (!$imagePath) {
                    return redirect()->route('add.company')->with('error', 'Failed to upload company image.');
                }
                $company->company_image = $imagePath;
            }
    
            $company->save();
    
            return redirect()->route('add.company')->with('success', 'Company updated successfully!');
        } else {
            // Add a new company
            $imagePath = null;
            if ($request->hasFile('company_image')) {
                $imagePath = $request->file('company_image')->store('company_logo', 'public');
                if (!$imagePath) {
                    return redirect()->back()->with('error', 'Failed to upload company image.');
                }
            }
            Company::create([
                'company_name' => $validatedData['company_name'],
                'company_image' => $imagePath,
                'company_status' => 1,
            ]);
    
            return redirect()->back()->with('success', 'Company added successfully!');
        }
    }
    
    public function editCompany($id)
    {
        $companies = Company::all();

        $editCompanies = Company::find($id);
        return view('company.addCompany', compact('editCompanies','companies'));
    }
    public function destroy($id)
    {

        $Company = Company::find($id);
        $Company->delete();

        return redirect()->route('add.company')->with('success', 'Company Name deleted successfully.');
    }

}
