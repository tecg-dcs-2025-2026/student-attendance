<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('matricule')->unique();
            $table->date('birth_date')->nullable();
            $table->string('profile_photo')->nullable();
            $table->timestamps();
            $table->softdeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};
