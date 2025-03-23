<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LabTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LabTestController extends Controller
{
    public function index()
    {
        $labTests = LabTest::with(['patient', 'doctor'])->paginate(10);
        return view('dashboard.lab-tests.index', compact('labTests'));
    }

    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.lab-tests.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:users,id',
            'test_type' => 'required|string|max:255',
            'result' => 'required|date',

        ]);

        $data = $request->except('report_file');

        if ($request->hasFile('report_file')) {
            $path = $request->file('report_file')->store('lab-tests', 'public');
            $data['report_file'] = $path;
        }

        LabTest::create($data);
        return redirect()->route('lab-test.index')->with('success', 'Lab test created successfully');
    }

    public function show($id)
    {
        $labTest = LabTest::with(['patient', 'doctor'])->findOrFail($id);
        return view('dashboard.lab-tests.show', compact('labTest'));
    }

    public function edit($id)
    {
        $labTest = LabTest::findOrFail($id);
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.lab-tests.edit', compact('labTest', 'doctors', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:users,id',
            'test_type' => 'required|string|max:255',
            'result' => 'required|date',
        ]);

        $labTest = LabTest::findOrFail($id);
        $data = $request->except('report_file');

        if ($request->hasFile('report_file')) {
            // Delete old file if exists
            if ($labTest->report_file) {
                Storage::disk('public')->delete($labTest->report_file);
            }
            $path = $request->file('report_file')->store('lab-tests', 'public');
            $data['report_file'] = $path;
        }

        $labTest->update($data);
        return redirect()->route('lab-test.index')->with('success', 'Lab test updated successfully');
    }

    public function destroy($id)
    {
        $labTest = LabTest::findOrFail($id);

        // Delete report file if exists
        if ($labTest->report_file) {
            Storage::disk('public')->delete($labTest->report_file);
        }

        $labTest->delete();
        return redirect()->route('lab-test.index')->with('success', 'Lab test deleted successfully');
    }

    public function downloadReport($id)
    {
        $labTest = LabTest::findOrFail($id);

        if (!$labTest->report_file) {
            return back()->with('error', 'No report file available');
        }

        return Storage::disk('public')->download($labTest->report_file);
    }
}
