<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function  index()
    {
        $users = User::all();
        return view('dashboard.employees.users', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.employees.addUser', compact('roles'));
    }
    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
            'role' => $validation['role']
        ]);

        $user->assignRole($validation['role']);
        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('dashboard.employees.editUser', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
    {
        $validation = $request->validate([
            'name' => 'required',
            'role' => 'required',
        ]);
        $user->update([
            'name' => $validation['name'],
            'role' => $validation['role']
        ]);
        $user->syncRoles($validation['role']);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
