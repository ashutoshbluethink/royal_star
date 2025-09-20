<?php

namespace App\Http\Controllers\profile;

use Illuminate\Http\Request;
use App\Models\Profile\profile;
use App\Models\profile\ProfileEmailPass;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::all();
        return view('profiles.index', compact('profiles'));
    }

    public function create()
    {
        $profiles = Profile::all();
        return view('profiles.create', compact('profiles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'profile_name' => 'required',
            'ring_central_number' => 'required',
            'username' => 'required',
            'password' => 'required',
            'email_id.*' => 'required', 
            'email_password.*' => 'required', 
        ]);
    
        // Create the profile
        $profile = Profile::create($request->all());
    
        // Retrieve the inserted profile ID
        $profileId = $profile->id;
    
        // Insert email IDs and passwords into the profile_email_pass table
        foreach ($request->input('email_id') as $key => $email) {
            ProfileEmailPass::create([
                'profile_id' => $profileId,
                'email' => $email,
                'password' => $request->input('email_password')[$key],
            ]);
        }
    
        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    public function edit(Profile $profile)
    {
        $profiles = Profile::all();
        return view('profiles.edit', compact('profile', 'profiles'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
            'profile_name' => 'required',
            'ring_central_number' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Find the profile by ID
        $profile = Profile::findOrFail($id);
    
        // Update the profile attributes
        $profile->profile_name = $request->input('profile_name');
        $profile->ring_central_number = $request->input('ring_central_number');
        $profile->username = $request->input('username');
        $profile->password = $request->input('password');
    
        // Save the changes
        $profile->save();

        
    
        // Redirect back with a success message
        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
