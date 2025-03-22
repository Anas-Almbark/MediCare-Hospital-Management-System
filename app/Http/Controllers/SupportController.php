<?php

namespace App\Http\Controllers;

use App\Models\Support;
use Illuminate\Http\Request;


class SupportController extends Controller
{
    public function create(){
        return view('userTemplate.support.index');
    }
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "message" => "required",
        ]);
    }
        
    
           
        
  

    public function index()
    {
        $supports = Support::all();
        return view("supports.index", compact("supports"));
    }
    public function usermessages(){
        $supports = Support::all();
        return view("supports.userMessages", compact("supports"));
    }
    public function updateStatus($id){
        $message = Support::findorfail($id);
        $message->update(['status' => 'resolved']);
        return back()->with('success', 'تم تغيير حالة الرسالة إلى "تم الحل".');
    }
    public function show(Support $support)
    {
        return view("supports.show", compact("support"));
    }
    public function edit(Support $support)
    {
        return view("supports.edit", compact("support"));
    }
    public function update(Request $request, Support $support)
    {
        $request->validate([
            "response" => "required",
        ]);
        $support->update([
            "response" => $request->response,
        ]); 
        return redirect()->back()->with("success","Message Reply successfully");
    }
    public function destroy(Support $support)
    {
        $support->delete();
        return redirect()->route('supports.index')->with("success","Message deleted successfully");
    }
       
}
