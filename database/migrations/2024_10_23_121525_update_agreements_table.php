<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     public function up()
    {
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('doctor_id')->constrained()->onDelete('cascade');
            $table->text('agreement_text');
            $table->text('terms_and_conditions');
            $table->text('e_signature');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('agreements');
    }
};
