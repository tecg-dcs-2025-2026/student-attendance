<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Table(key: 'id', keyType: 'string', incrementing: false)]
class Lesson extends Model
{
    use HasFactory, HasUuids;

    protected function casts(): array
    {
        return [

            'starts_at' => 'datetime',
            'ends_at' => 'datetime',

        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'attendances')
            ->using(Attendance::class)
            ->withTimestamps();
    }
}
