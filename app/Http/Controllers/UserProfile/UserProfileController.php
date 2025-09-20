<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserProfileController extends Controller
{
    // Method for showing user profile
    public function showUserProfile()
    {
        // Get the ID of the currently logged-in user
        $userId = Auth::id();

        // Fetch the user data by user ID
        // $user = User::find($userId);

        $user = User::select('users.*', 'roles.role_name')
                    ->leftJoin('roles', 'users.role', '=', 'roles.role_id')
                    ->where('users.user_id', $userId)
                    ->first();

                     $roleName = $user->role_name;
        
        // echo"<pre>";
       
        // print_r($user);
        // die;
        // Pass the user data to the Blade view
        return view('userProfile.profile', compact('user', 'roleName'));
    }

    // Method for showing user passchange blede file
    public function changepassword()
    {

        return view('userProfile.changePass');
    }

    public function updatePassword(Request $request)
    {
    
        // Validate the input
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'], // 'confirmed' checks for new_password_confirmation
        ]);

        // Get the currently authenticated user
        $user = auth()->user();

        // Check if the current password is correct
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Return success message
        return redirect()->back()->with('success', 'Your password has been successfully updated.');
    }

}
