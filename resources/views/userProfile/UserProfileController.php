<?php

namespace App\Http\Controllers\UserProfile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
}
