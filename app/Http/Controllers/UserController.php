<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
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
        ]);

        $user->syncRoles($validation['role']);
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }

    public function searchByName()
    {
        $users = User::search(request()->input('search'))->get();
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
    }
    public function filterByRole()
    {
        $users = User::filterByRole(request()->input('role'))->get();
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
    }
}
