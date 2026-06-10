<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table('enrolments', key: 'id', keyType: 'string', incrementing: false)]
class Enrolment extends Pivot
{
    use HasUuids;

    protected static function booted(): void
    {
        static::created(function (Enrolment $enrolment) {
            foreach ($enrolment->course->lessons as $lesson) {
                $lesson->students()->attach($enrolment->student_id);
            }
        });
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }
}
