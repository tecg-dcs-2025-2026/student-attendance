<?php
use Illuminate\Database\Capsule\Manager as Capsule;

include __DIR__ . '/../connexion.php';

Capsule::schema()->drop('students');
Capsule::schema()->create('students', function($table){
    $table->increments('id');
    $table->string('first_name');
    $table->string('last_name');
    $table->string('email')->unique();
    $table->string('matricule')->unique();
    $table->date('birth_date')->nullable();
    $table->string('profile_photo')->nullable();
    $table->timestamps();
    $table->softdeletes();
});