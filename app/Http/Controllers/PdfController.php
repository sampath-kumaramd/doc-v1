<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Agreement;
use PDF;

class PdfController extends Controller
{
    public function generateAgreementPdf($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $agreement = Agreement::where('doctor_id', $doctorId)->firstOrFail();

        $pdf = PDF::loadView('pdf.agreement', compact('doctor', 'agreement'));

        return $pdf->download('doctor_agreement.pdf');
    }
}

