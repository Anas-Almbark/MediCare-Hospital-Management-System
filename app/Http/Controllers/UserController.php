<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Specialization;
use Illuminate\Support\Facades\Storage;
use App\Models\LabTest;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
    }

    public function create()
    {
        $roles = Role::all();
        $specializations = Specialization::all();
        return view('dashboard.employees.addUser', compact('roles', 'specializations'));
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
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $userData = [
            'name' => $validation['name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
            'birth_date' => $validation['birth_date'],
            'gender' => $validation['gender'],
            'blood_type' => $validation['blood_type'],
            'phone_number' => $validation['phone'],
            'address' => $validation['address'],
            'identity_number' => $validation['identity_number'],
        ];

        $userData = $request->except('profile_photo');

        // Only set profile_photo if an image was uploaded
        if ($request->hasFile('profile_photo')) {
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $userData['profile_photo'] = $path;
        }
        // Don't set any default value for profile_photo

        $user = User::create($userData);
        $user->assignRole($validation['role']);

        if ($validation['role'] === 'doctor') {
            return app(DoctorController::class)->createDoctor($user, $request);
        }

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        $specializations = Specialization::all();  // Add this line
        return view('dashboard.employees.editUser', compact('user', 'roles', 'specializations'));
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

        if ($request->hasFile('profile_photo')) {
            // Delete old photo if exists
            if ($user->profile_photo) {
                Storage::disk('public')->delete($user->profile_photo);
            }

            // Store new photo
            $path = $request->file('profile_photo')->store('profile-photos', 'public');
            $user->profile_photo = $path;
        }

        // Update other user fields
        $user->update([
            'name' => $request->name,
            'birth_date' => $request->birth_date,
            'blood_type' => $request->blood_type,
            'address' => $request->address,
            'phone_number' => $request->phone,
            'status_account' => $request->status_account,
            'profile_photo' => $user->profile_photo, // Add this line to save the photo path
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
        $users = User::search(request()->input('search'))->paginate(10);
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
    }
    public function filterByRole()
    {
        $users = User::filterByRole(request()->input('role'))->paginate(10);
        $roles = Role::all();
        return view('dashboard.employees.users', compact('users', 'roles'));
    }
    public function idFetch()
    {
        $users = User::where('id', '!=', Auth::id())
            ->latest()
            ->get();
        $countRoles = $users->load('roles')->pluck('roles')->flatten()->pluck('name')->countBy();
        $labTests = LabTest::all();
        return view('dashboard.main', compact('users', 'labTests', 'countRoles'));
    }
}
