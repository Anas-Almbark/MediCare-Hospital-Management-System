<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::all();
        $roles = Role::all();
        $specialties = [
            'Cardiology',
            'Dermatology',
            'Neurology',
            'Orthopedics',
            'Pediatrics',
            'Psychiatry',
            'Oncology',
            'General Medicine',
            'Surgery',
            'Gynecology'
        ];
        return view('dashboard.doctors.index', compact('doctors', 'roles', 'specialties'));
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

    public function edit(Doctor $doctor)
    {
        $roles = Role::all();
        return view('dashboard.doctors.edit', compact('doctor', 'roles'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $doctor->update($request->all());
        return redirect()->route('doctor.index')->with('success', 'Doctor updated successfully');
    }

    public function destroy(Doctor $doctor)
    {
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

