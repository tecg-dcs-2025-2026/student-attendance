<?php

namespace App\Http\Controllers;

use App\Models\Lesson;

class LessonController extends Controller
{
    public function show(Lesson $lesson)
    {
        if ($lesson->course->user_id !== auth()->id()) {
            return redirect(route('home'));
        }

        $students = $lesson->students()->orderBy('last_name')->get();
        return view('lessons.show', compact('lesson', 'students'));
    }
}
