<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Agreement</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>
<body>
    <h1>Doctor Agreement</h1>
    <p>Doctor Name: {{ $doctor->user->name }}</p>
    <div>
        {!! $agreement->agreement_text !!}
    </div>
    <h2>Terms and Conditions</h2>
    <div>
        {!! $agreement->terms_and_conditions !!}
    </div>
    <h2>E-Signature</h2>
    <img src="{{ $agreement->e_signature }}" alt="Doctor's E-Signature">
</body>
</html>

