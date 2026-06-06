<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View as ContractView;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CourseController extends Controller
{
    public function index()
    {
        $title = ucfirst(__('headings.my-courses'));
        $user = auth()->user()->load([
            'courses' => function ($query) {
                $query
                    ->orderBy('name', 'asc')
                    ->withCount('students');
            },
        ]);

        return view(
            'courses.index',
            compact('user', 'title')
        );
    }

    public function show(Course $course
    ): Factory|ContractView|View|RedirectResponse {

        if ($course->user_id !== auth()->id()) {
            return redirect(route('home'));
        }

        $title = $course->name;
        $course->load(['lessons' => fn ($query) => $query->orderBy('starts_at', 'asc')]);

        return view(
            'courses.show',
            compact('course', 'title')
        );
    }
}
