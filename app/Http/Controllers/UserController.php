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
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|exists:roles,name',
            'birth_date' => 'required|date|before:today',
            'gender' => 'required|in:male,female',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:18',
            'address' => 'required|string|max:255',
            'identity_number' => 'required|string|unique:users|min:6|max:30',
        ]);

        $user = User::create([
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
            'birth_date' => $validation['birth_date'],
            'gender' => $validation['gender'],
            'blood_type' => $validation['blood_type'],
            'phone_number' => $validation['phone'],
            'address' => $validation['address'],
            'identity_number' => $validation['identity_number'],
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
            'name' => 'nullable|max:255',
            'role' => 'nullable|exists:roles,name',
            'birth_date' => 'nullable|date|before:today',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:7|max:18',
            'address' => 'nullable|max:255',
            "status_account" => "nullable|in:active,not-active,banded",
        ]);

        $user->update([
            'name' => $validation['name'],
            'birth_date' => $validation['birth_date'],
            'blood_type' => $validation['blood_type'],
            'phone_number' => $validation['phone'],
            'address' => $validation['address'],
            "status_account" => $validation['status_account'],
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
    public function idFetch()
    {
        $users = User::where('id', '!=', auth()->id())
<<<<<<< HEAD
                 ->latest()
                 ->get();
                 
        return view('dashboard.main', compact('users'));  
=======
            ->latest()
            ->get();

        return view('dashboard', compact('users'));
>>>>>>> ae698452e79d094c4b50c29106207a8cfdf59db5
    }
}
