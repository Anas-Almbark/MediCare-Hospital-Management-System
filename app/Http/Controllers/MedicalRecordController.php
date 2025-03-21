<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Attachment;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['patient', 'doctor'])->paginate(10);
        return view('dashboard.medical-records.index', compact('records'));
    }

    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.medical-records.create', compact('doctors', 'patients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:users,id',
            'diagnosis' => 'required|string',
            'prescription_id' => 'required|string',
        ]);

        $record = MedicalRecord::create($request->except('attachments'));

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('medical-records', 'public');
                $record->attachments()->create(['path' => $path]);
            }
        }

        return redirect()->route('medical-record.index')->with('success', 'Medical record created successfully');
    }

    public function show($id)
    {
        $record = MedicalRecord::with(['patient', 'doctor', 'attachments'])->findOrFail($id);
        return view('dashboard.medical-records.show', compact('record'));
    }

    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view('dashboard.medical-records.edit', compact('record', 'doctors', 'patients'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'patient' => 'required|exists:users,id',
            'doctor' => 'required|exists:users,id',
            'diagnosis' => 'required|string',
            'prescription_id' => 'required|string',
        ]);

        $record = MedicalRecord::findOrFail($id);
        $record->update($request->except('attachments'));

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('medical-records', 'public');
                $record->attachments()->create(['path' => $path]);
            }
        }

        return redirect()->route('medical-record.index')->with('success', 'Medical record updated successfully');
    }

    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        
        // Delete associated attachments from storage
        foreach ($record->attachments as $attachment) {
        Storage::disk('public')->delete($attachment->path);
            $attachment->delete();
        }
        
        $record->delete();
        return redirect()->route('medical-record.index')->with('success', 'Medical record deleted successfully');
    }

    public function deleteAttachment($id)
    {
        $attachment = Attachment::findOrFail($id);
        Storage::disk('public')->delete($attachment->path);
        $attachment->delete();
        
        return back()->with('success', 'Attachment deleted successfully');
    }
}
