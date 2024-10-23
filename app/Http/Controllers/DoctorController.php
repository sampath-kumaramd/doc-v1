<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Agreement;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function showAgreement()
    {
        $termsAndConditions = TermsAndConditions::latest()->first();
        return view('doctor.agreement', compact('termsAndConditions'));
    }

    public function submitAgreement(Request $request)
    {
        $validatedData = $request->validate([
            'e_signature' => 'required',
        ]);

        $doctor = auth()->user()->doctor;
        
        Agreement::create([
            'doctor_id' => $doctor->id,
            'agreement_text' => 'Your agreement text here',
            'terms_and_conditions' => TermsAndConditions::latest()->first()->content,
            'e_signature' => $validatedData['e_signature'],
        ]);

        return redirect()->route('doctor.dashboard');
    }

    public function dashboard()
    {
        $doctor = auth()->user()->doctor;
        return view('doctor.dashboard', compact('doctor'));
    }
}

