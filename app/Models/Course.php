<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table(key: 'id', keyType: 'string', incrementing: false)]
class Course extends Model
{
    use HasFactory, HasUuids;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function lessons(): HasMany
    {
        return $this->hasMany(Lesson::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'enrolments')
            ->using(Enrolment::class)
            ->withTimestamps();
    }
}
