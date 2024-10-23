<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable = [
        'user_id', 'age', 'qualifications', 'gender', 'mobile_no', 'address',
        'city', 'state', 'country', 'signature_proof', 'medical_registration_certificate',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

