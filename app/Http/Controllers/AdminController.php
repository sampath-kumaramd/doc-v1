<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $pendingDoctors = Doctor::where('status', 'pending')->get();
        return view('admin.dashboard', compact('pendingDoctors'));
    }

    public function viewDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('admin.view-doctor', compact('doctor'));
    }

    public function approveDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['status' => 'approved']);
        return redirect()->route('admin.dashboard')->with('success', 'Doctor approved successfully');
    }

    public function rejectDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $doctor->update(['status' => 'rejected']);
        return redirect()->route('admin.dashboard')->with('success', 'Doctor rejected successfully');
    }

    public function showTermsAndConditions()
    {
        $termsAndConditions = TermsAndConditions::latest()->first();
        return view('admin.terms-and-conditions', compact('termsAndConditions'));
    }

    public function updateTermsAndConditions(Request $request)
    {
        $validatedData = $request->validate([
            'content' => 'required',
        ]);

        TermsAndConditions::create($validatedData);

        return redirect()->route('admin.terms-and-conditions')->with('success', 'Terms and conditions updated successfully');
    }
}

