@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Doctor Agreement</h2>
    <div id="agreement-text">
        <!-- Display agreement text here -->
    </div>
    <div id="terms-and-conditions">
        {{ $termsAndConditions->content }}
    </div>
    <form method="POST" action="{{ route('doctor.submit-agreement') }}">
        @csrf
        <div class="form-group">
            <label for="e_signature">E-Signature</label>
            <div id="signature-pad"></div>
            <input type="hidden" id="e_signature" name="e_signature">
        </div>
        <button type="submit" class="btn btn-primary">Submit Agreement</button>
    </form>
</div>
@endsection

