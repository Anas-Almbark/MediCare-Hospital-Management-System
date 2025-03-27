<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::all();
        
        return view('welcome', compact('reviews'));
    }
    public function create()
    {
        return view('indexTemplate.evaluation.create');
    }

    public function store(Request $request)
    {
       $validation=$request->validate([
            'nmae' => '',
            'comment' => '',

        ]);

        $review = Review::create([
            ...$validation,
            'user_id' => Auth::id(),
        ]);

       return redirect()->route('welcome')->with('success', 'تم إضافة التقييم بنجاح');
    }
    
}
