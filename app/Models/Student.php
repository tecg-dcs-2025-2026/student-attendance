<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Table(key: 'id', keyType: 'string', incrementing: false)]
class Student extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'matricule',
        'birth_date',
    ];

    public function lessons(): BelongsToMany
    {
        return $this->belongsToMany(Lesson::class, 'attendances')
            ->using(Attendance::class)
            ->withTimestamps();
    }
}
