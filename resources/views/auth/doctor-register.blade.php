@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Doctor Registration</h2>
    <form method="POST" action="{{ route('doctor.register') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="mobile_no">Mobile Number</label>
            <input type="tel" class="form-control" id="mobile_no" name="mobile_no" required>
            <button type="button" id="send-otp">Send OTP</button>
        </div>
        <div class="form-group">
            <label for="otp">OTP</label>
            <input type="text" class="form-control" id="otp" name="otp" required>
            <button type="button" id="verify-otp">Verify OTP</button>
        </div>
        <!-- Add other fields like age, qualifications, gender, address, etc. -->
        <div class="form-group">
            <label for="signature_proof">Signature Proof</label>
            <input type="file" class="form-control-file" id="signature_proof" name="signature_proof" required>
        </div>
        <div class="form-group">
            <label for="medical_registration_certificate">Medical Registration Certificate</label>
            <input type="file" class="form-control-file" id="medical_registration_certificate" name="medical_registration_certificate" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
</div>
@endsection

