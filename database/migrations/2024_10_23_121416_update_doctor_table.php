<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('age');
            $table->text('qualifications');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->string('mobile_no');
            $table->text('address');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('signature_proof');
            $table->string('medical_registration_certificate');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('doctors');
    }
};
