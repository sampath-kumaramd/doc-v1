@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Doctor Dashboard</h2>
    <p>Welcome, {{ auth()->user()->name }}</p>
    <p>Registration Status: {{ $doctor->status }}</p>
    <!-- Display other doctor details and functionalities -->
</div>
@endsection
