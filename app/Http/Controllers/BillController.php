<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = \App\Models\Bill::with(['doctor', 'patient'])->paginate(10);
        return view("dashboard.bills.index", compact("bills"));
    }
    public function create()
    {
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view("dashboard.bills.create", compact('doctors', 'patients'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'required|exists:users,id',
            'amount' => 'required|numeric',
            'details' => 'required',
        ]);
$bill = \App\Models\Bill::create([
    'patient' => $request->patient_id,
    'doctor' => $request->doctor_id,
    'amount' => $request->amount,
    'description' => $request->details
]);
        return redirect()->route("bill.index")->with('success','added bill successfully');
    }
    public function show($id)
    {
        $bill = \App\Models\Bill::with(['doctor', 'patient'])->findOrFail($id);
        return view("dashboard.bills.show", compact("bill"));
    }
    public function edit($id)
    {
        $bill = \App\Models\Bill::find($id);
        $doctors = User::role('doctor')->get();
        $patients = User::role('patient')->get();
        return view("dashboard.bills.edit",compact("bill",'doctors', 'patients'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'patient_id' =>'required|exists:users,id',
            'doctor_id' =>'required|exists:users,id',
            'amount' =>'required|numeric',
            'details' =>'required',
        ]);
        $bill = \App\Models\Bill::find($id);
        $bill->update([
            'patient' => $request->patient_id,
            'doctor' => $request->doctor_id,
            'amount' => $request->amount,
            'description' => $request->details
        ]);
        return redirect()->route("bill.index")->with('success','updated bill successfully');
    }
    public function destroy($id)
    {
        $bill = \App\Models\Bill::find($id);
        $bill->delete();
        return redirect()->route("bill.index")->with('success','deleted bill successfully');
    }
    
}
