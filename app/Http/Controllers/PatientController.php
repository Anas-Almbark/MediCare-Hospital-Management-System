<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function about()
    {
        return view('about');
    }

    public function services()
    {
        return view('services');
    }

    public function doctors()
    {
        return view('doctors');
    }

    public function doctorsDetail()
    {
        return view('doctors-detail');
    }
}
