<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminRoles;

use Illuminate\Support\Facades\Auth;


class AdminMgmtController extends Controller
{
    public function listAdmin($role_id)
    {
        $user = Auth::user();

        if ($user->role_id != $role_id) {
            abort(403, 'Unauthorized action.');
        }

        $search = request()->input('search');
        $query = User::with('role');

        if ($search) {
            $query->where('username', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere(function ($query) use ($search) {
                    if (strtolower($search) === 'active') {
                        $query->where('active', 1);
                    } elseif (strtolower($search) === 'inactive') {
                        $query->where('active', 0);
                    }
                })
                ->orWhereHas('role', function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%");
                });
                
        }

        $listofAdmins = $query->paginate(10)->appends(['search' => $search]); 
        $roles = AdminRoles::all();

        return view('dashboard.aa.adminmgmt', compact('listofAdmins', 'user', 'role_id', 'roles', 'search'));
    }


    public function addAdmin(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin', 
            'email' => 'required|email|max:255|unique:admin',
            'role_id' => 'required|exists:admin_roles,id',
            'password' => 'required|string|min:5',
        ]);

        $validated['password'] = bcrypt($validated['password']);

        $newadmin = new User();
        $newadmin->username = $validated['username'];
        $newadmin->email = $validated['email'];
        $newadmin->password = $validated['password'];
        $newadmin->role_id = $validated['role_id']; 
        $newadmin->active = $request->has('active') ? 1 : 0; 
        $newadmin->save();

        return redirect()->back()->with('success', 'Admin added successfully!');
    }


    public function updateAdmin(Request $request, $id)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255|unique:admin,username,' . $id,
            'email' => 'required|email|max:255|unique:admin,email,' . $id,
            'role_id' => 'required|exists:admin_roles,id', 
            'active' => 'nullable|boolean',
        ]);

        $admin = User::findOrFail($id);

        $admin->username = $validated['username'];
        $admin->email = $validated['email'];
        $admin->role_id = $validated['role_id'];
        $admin->active = $request->has('active') ? $validated['active'] : 0;


        $admin->save();
        $user = Auth::user();

        return redirect()->route('admin.adminmgmt', ['role_id' => $user->role_id])->with('success', 'Admin updated successfully!');
    }

}
