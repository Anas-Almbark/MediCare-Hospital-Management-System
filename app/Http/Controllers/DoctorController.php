<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Specialization;
class DoctorController extends Controller
{


    public function create()
    {
        $roles = Role::all();
        return view('dashboard.doctors.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'specialization' => 'required|exists:specializations,id',
            'license_number' => 'required|unique:doctors',
            'experience_years' => 'required|numeric|min:0',
            'phone' => 'required',
            'birth_date' => 'required|date',
            'gender' => 'required|in:male,female',
            'blood_type' => 'nullable|in:A+,A-,B+,B-,AB+,AB-,O+,O-',
            'address' => 'required',
            'identity_number' => 'required|unique:users',
        ]);

        // Create user first
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

        // Assign doctor role
        $user->assignRole('doctor');

        // Create doctor record
        $doctor = Doctor::create([
            'doctor' => $user->id,
            'specialization_id' => $validation['specialization'],
            'license_number' => $validation['license_number'],
            'experience_years' => $validation['experience_years'],
        ]);

        return redirect()->route('doctor.index')->with('success', 'Doctor created successfully');
    }

    public function index()
    {
        $doctors = Doctor::with(['user', 'specialization'])->get();
        $specializations = Specialization::all();
        
        return view('dashboard.doctors.index', compact('doctors', 'specializations'));
    }

    public function showDoctorsForHome()
    {
        $doctors = User::role('doctor')
            ->with('doctor.specialization')
            ->take(4)
            ->get();
        return view('welcome', compact('doctors'));
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

    public function createDoctor(User $user, Request $request)
        {
            $validation = $request->validate([
                'specialization' => 'required|exists:specializations,id',
                'license_number' => 'required|string|unique:doctors,license_number',
                'experience_years' => 'required|numeric|min:0',
            ]);
    
            Doctor::create([
                'doctor' => $user->id,
                'specialization_id' => $validation['specialization'],
                'license_number' => $validation['license_number'],
                'experience_years' => $validation['experience_years']
            ]);
    
            return redirect()->route('user.index')->with('success', 'Doctor created successfully');
        }
}

