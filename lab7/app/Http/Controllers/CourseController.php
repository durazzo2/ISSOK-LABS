<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $query = Course::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        $courses = $query->get(['title', 'level', 'start_date', 'seats']);

        return response()->json($courses);
    }

    public function store(CreateCourseRequest $request)
    {
        $course = Course::create($request->validated());

        return response()->json($course, 201);
    }

    public function show(Course $course)
    {
        $course->load('enrollments');

        return response()->json([
            'title' => $course->title,
            'summary' => $course->summary,
            'level' => $course->level,
            'start_date' => $course->start_date,
            'seats' => $course->seats,
            'enrollments' => $course->enrollments,
        ]);
    }

    public function update(UpdateCourseRequest $request, Course $course)
    {
        $course->update($request->validated());

        return response()->json($course);
    }

    public function destroy(Course $course)
    {
        $approvedEnrollments = $course->enrollments()->where('status', 'approved')->exists();

        abort_if($approvedEnrollments, 400, 'Cannot delete course with approved enrollments.');

        $course->delete();

        return response()->json(null, 204);
    }
}
