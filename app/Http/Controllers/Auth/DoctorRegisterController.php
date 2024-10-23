<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorRegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.doctor-register');
    }

    public function register(Request $request)
    {
        // Validate input
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'signature_proof' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
            'medical_registration_certificate' => ['required', 'file', 'mimes:jpeg,png,pdf', 'max:2048'],
            // Add other validation rules
        ]);

        // Create user
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => 'doctor',
        ]);

        // Handle file uploads
        $signatureProofPath = $request->file('signature_proof')->store('signature_proofs', 'public');
        $certificatePath = $request->file('medical_registration_certificate')->store('certificates', 'public');

        // Create doctor profile
        $doctor = Doctor::create([
            'user_id' => $user->id,
            'signature_proof' => $signatureProofPath,
            'medical_registration_certificate' => $certificatePath,
            // Add other doctor-specific fields here
        ]);

        // Log the user in
        auth()->login($user);

        return redirect()->route('doctor.agreement');
    }
}
