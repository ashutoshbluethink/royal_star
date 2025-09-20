<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\profile\Profile;
use App\Models\profile\ProfileEmailPass;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::with('emailPasses')->get();
        // echo"<pre>";
        // print_r($profiles);
        // die;
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
            'comment' => 'nullable',
        ]);
    
        // Create the profile
        $profile = new Profile();

        // Assign values from the request to the profile attributes
        $profile->profile_name = $request->input('profile_name');
        $profile->ring_central_number = $request->input('ring_central_number');
        $profile->username = $request->input('username');
        $profile->password = $request->input('password');
        $profile->comment = $request->input('comment');
        
        // Save the profile
        $profile->save();
    
        // Retrieve the inserted profile ID
        $profileId = $profile->id;
 
        foreach ($request->input('email_id') as $key => $email) {
            ProfileEmailPass::create([
                'profile_id' => $profileId,
                'email_id' => $email,
                'email_password' => $request->input('email_password')[$key],
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
            'comment' => 'nullable',
        ]);
    
        // Find the profile by ID
       echo  $profile = Profile::findOrFail($id);
        // Update the profile attributes
        $profile->profile_name = $request->input('profile_name');
        $profile->ring_central_number = $request->input('ring_central_number');
        $profile->username = $request->input('username');
        $profile->password = $request->input('password');
        $profile->comment = $request->input('comment');
        $profile->save();

        foreach($request->input('email_pass_id') as $key => $emailPassId) {
            // Find the associated profile_email_pass record by its ID
            $emailPass = ProfileEmailPass::find($emailPassId);
            
            // If the record exists, update the password
            if ($emailPass) {
                $emailPass->email_id = $request->input('email_id')[$key];
                $emailPass->email_password = $request->input('email_password')[$key];
                $emailPass->save();
            }
        }
        
            // Redirect back with a success message
            return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
        }

    public function destroy(Profile $profile)
    {
        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
