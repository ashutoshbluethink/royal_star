<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Technology;
use App\Models\Vendor\Vendor;


class VendorController extends Controller
{
        // Display a listing of the vendors
        public function index()
        {
            $vendors = Vendor::with('technology')->get();
            return view('vendors.index', compact('vendors'));
        }
    
        // Show the form for creating a new vendor
        public function create()
        {
            $technologies = Technology::where('technology_status', 1)->get();
            return view('vendors.createVendor', compact('technologies'));
        }
    
        // Store a newly created vendor in the database
        public function store(Request $request)
        {
            $request->validate([
                'name' => 'required',
                'email' => 'required|email|unique:vendors,email',
            ]);
        
            $vendor = new Vendor();
            
            $vendor->name = $request->input('name');
            $vendor->email = $request->input('email');
            $vendor->alternate_email = $request->input('alternate_email');
            $vendor->phone_number = $request->input('phone_number');
            $vendor->alternate_phone_number = $request->input('alternate_phone_number');
            $vendor->technology_id = $request->input('technology_id');
            $vendor->comment = $request->input('comment');
            
            $vendor->save();
            
            return redirect()->route('vendors.createVendor')->with('success', 'Vendor added successfully.');
        }
        
    
        // Show the form for editing the specified vendor
        public function edit($id)
        {
            $vendor = Vendor::findOrFail($id); // Retrieve the vendor record by ID
            return view('vendors.editVendor', compact('vendor'));
        }
    
        public function update(Request $request)
        {
            // Validate request data
            $validatedData = $request->validate([
                'vendor_id' => 'required',
                'name' => 'required',
                'email' => 'required',
                'technology_id' => 'nullable',
                'phone_number' => 'nullable',
                'alternate_email' => 'nullable|email',
                'alternate_phone_number' => 'nullable',
                'comment' => 'nullable',
            ]);
    
            // Find the vendor by vendor_id
            $vendor = Vendor::findOrFail($request->input('vendor_id'));
    
            // Update the vendor
            $vendor->update($validatedData);
    
            return redirect()->route('vendors.index')->with('success', 'Vendor updated successfully.');
        }
    
        // Remove the specified vendor from the database
        public function destroy(Vendor $vendor)
        {
            $vendor->delete();
            return redirect()->route('vendors.index')->with('success', 'Vendor deleted successfully.');
        }
}
