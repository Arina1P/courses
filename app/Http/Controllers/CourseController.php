<?php

namespace App\Http\Controllers;

use App\Http\Requests\SearchRequest;
use App\Http\Resources\CourseResource;
use App\Models\Course;

class CourseController extends Controller
{
    public function index()
    {
        $resources = Course::all();

        return response()->json([
            'resources' => CourseResource::collection($resources),
        ]);
    }

    public function show(Course $course)
    {
        $course->load(['lessons', 'type']);

        return response()->json([
            'resource' => CourseResource::make($course),
        ]);
    }

    public function search(SearchRequest $request)
    {
        $keyword = $request->validated('string');

        $resources = Course::where('title', 'like', '%' . $keyword . '%')
            ->orWhereHas('type', function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%');
            })
            ->get();

        return response()->json([
            'resources' => CourseResource::collection($resources),
        ]);
    }
}
