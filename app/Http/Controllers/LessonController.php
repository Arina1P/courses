<?php

namespace App\Http\Controllers;

use App\Http\Resources\LessonResource;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

class LessonController extends Controller
{
    public function index(Course $course): JsonResponse
    {
        $resources = Lesson::query()
            ->where('course_id', $course->getKey())
            ->withCount(['users' => function ($query) {
                $query->where('user_id', auth()?->user()->getKey());
            }])
            ->get();

        return response()->json([
            'resources' => LessonResource::collection($resources),
        ]);
    }

    public function show(Lesson $lesson): JsonResponse
    {
        $resource = $lesson->loadCount(['users' => function ($query) {
            $query->where('user_id', auth()->user()->getKey());
        }]);

        return response()->json([
            'resource' => LessonResource::make($resource),
        ]);
    }

    //когда юзер прошел урок
    public function passages(Lesson $lesson): \Illuminate\Http\Response
    {
        try {
            $lesson->users()->attach(auth()?->user()->getKey());
        } catch (\Exception $e) {
            logger([
                Route::currentRouteAction(),
                $e->getMessage(),
            ]);
        }

        return response()->noContent();
    }
}
