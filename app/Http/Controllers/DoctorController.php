<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
class DoctorController extends Controller
{
    public function index()
    {
        $doctors = User::role('doctor')->get();
        $specialties = [
            'Cardiology',
            'Neurology',
            'Pediatrics',
            'Orthopedics',
            'Dermatology',
            'General Medicine'
        ];
        
        return view('dashboard.doctors.index', compact('doctors', 'specialties'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('dashboard.doctors.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:doctors',
            'specialty' => 'required',
            'phone' => 'required',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $doctor = Doctor::create([
            'name' => $validation['name'],
            'email' => $validation['email'],
            'specialty' => $validation['specialty'],
            'phone' => $validation['phone'],
            'password' => Hash::make($validation['password']),
        ]);

        $doctor->assignRole($validation['role']);
        return redirect()->route('doctor.index')->with('success', 'Doctor created successfully');
    }

    public function edit($id)
    {
        $doctor = User::role('doctor')->findOrFail($id);
        $roles = Role::all();
        return view('dashboard.doctors.edit', compact('doctor', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $doctor = User::role('doctor')->findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'specialty' => 'required',
            'phone' => 'required',
        ]);
    
        $doctor->update($validated);
        
        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
    }

    public function destroy($id)
    {
        $doctor = User::role('doctor')->findOrFail($id);
        $doctor->delete();
        
        return redirect()->route('doctor.index')->with('success', 'Doctor deleted successfully');
    }

    public function searchByName()
    {
        $doctors = Doctor::search(request()->input('search'))->get();
        $roles = Role::all();
        return view('dashboard.doctors.index', compact('doctors', 'roles'));
    }

    public function filterByRole()
    {
        $doctors = Doctor::filterByRole(request()->input('role'))->get();
        $roles = Role::all();
        return view('dashboard.doctors.index', compact('doctors', 'roles'));
    }
}

