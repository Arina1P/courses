<?php

namespace App\Http\Controllers;

use App\Http\Resources\TestResource;
use App\Models\Lesson;
use App\Models\Test;
use Illuminate\Http\JsonResponse;

class TestController extends Controller
{
    public function index(Lesson $lesson): JsonResponse
    {
        $resources = $lesson->tests;

        return response()->json([
            'resources' => TestResource::collection($resources),
        ]);
    }

    public function show(Test $test): JsonResponse
    {
        $test->load(['tasks']);

        return response()->json([
            'resource' => TestResource::make($test),
        ]);
    }
}
