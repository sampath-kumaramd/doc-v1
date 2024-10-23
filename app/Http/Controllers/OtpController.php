<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;

class OtpController extends Controller
{
    protected $auth;

    public function __construct()
    {
        $factory = (new Factory)->withServiceAccount(base_path('path/to/firebase_credentials.json'));
        $this->auth = $factory->createAuth();
    }

    public function sendOtp(Request $request)
    {
        $phoneNumber = $request->input('phone_number');
        
        try {
            $verification = $this->auth->signInWithPhoneNumber($phoneNumber);
            return response()->json(['success' => true, 'verification_id' => $verification->verificationId()]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function verifyOtp(Request $request)
    {
        $verificationId = $request->input('verification_id');
        $otp = $request->input('otp');

        try {
            $this->auth->signInWithPhoneNumber($verificationId, $otp);
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
