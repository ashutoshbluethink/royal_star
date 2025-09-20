<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User\Role;


class RoleController extends Controller
{
    public function addRole()
    {
        $roles = Role::all();
        return view('user.role', compact('roles'));
    }

    public function submit(Request $request)
    {
        $request->validate([
            'role_name' => 'required|string|max:255', 
        ]);
    
        $role = new Role();
        $role->role_name = $request->input('role_name');
        $role->role_status = true; 

        $role->save();

        return redirect()->back()->with('success', 'New Role added successfully !');
    }

    public function edit($id)
    {
        $roles = Role::all();

        $editRole = Role::find($id);
        return view('user.edit-role', compact('editRole','roles'));
    }

    public function update(Request $request)
    {
        $role_id = $request->role_id;
        $role = Role::find($role_id);
        $role->role_name = $request->role_name;
        $role->role_status = $request->role_status;
        $role->save();
        
        return redirect()->route('add.role')->with('success', 'Role updated successfully.');
    }

    public function destroy($id)
    {

        $role = Role::find($id);
        $role->delete();

        return redirect()->route('add.role')->with('success', 'Role deleted successfully.');
    }
}
