<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agreement extends Model
{
    protected $fillable = [
        'doctor_id', 'agreement_text', 'terms_and_conditions', 'e_signature',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}

