<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function about()
    {
        return view('indexTemplate.about.about');
    }

    public function services()
    {
        return view('indexTemplate.about.services');
    }

    public function doctors()
    {
        return view('indexTemplate.doctors.doctors');
    }

    public function doctorsDetail()
    {
        return view('indexTemplate.doctors.doctors-detail');
    }
}
