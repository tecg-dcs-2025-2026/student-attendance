<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'first_name',
    'last_name',
    'email',
    'matricule',
    'birth_date',
    'profile_photo',
    'deleted_at',
])]
class Student extends Model
{
    use SoftDeletes;
}
