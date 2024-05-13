<?php

namespace App\Http\Controllers;

use App\Http\Requests\CheckAllRequest;
use App\Http\Requests\CheckRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\Test;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

class TaskController extends Controller
{
    public function index(Test $test): JsonResponse
    {
        $resources = $test->tasks;

        return response()->json([
            'resources' => TaskResource::collection($resources),
        ]);
    }

    public function show(Task $task): JsonResponse
    {
        return response()->json([
            'resource' => TaskResource::make($task),
        ]);
    }

    public function check(Task $task, CheckRequest $request): \Illuminate\Http\Response
    {
        try {
            if ($request->validated('answer') === $task->answer) {
                $task->users()->attach(auth()?->user()->getKey());
            }
        } catch (\Exception $e) {
            logger([
                Route::currentRouteAction(),
                $e->getMessage(),
            ]);
        }

        return response()->noContent();
    }

    public function checkAll(CheckAllRequest $request): JsonResponse
    {
        $answers = $request->validated('answers');
        $testId = $request->validated('test_id');

        // Получаем список всех задач для данного теста
        $tasks = Test::findOrFail($testId)->tasks;

        // Создаем массив для хранения результатов проверки
        $results = [];

        foreach ($tasks as $task) {
            // Получаем ответ пользователя для текущей задачи
            $userAnswer = collect($answers)->firstWhere('task_id', $task->id);

            // Проверяем, есть ли ответ пользователя и сравниваем его с правильным ответом
            $isCorrect = $userAnswer && $userAnswer['answer'] === $task->answer;

            // Добавляем результат проверки в массив
            $results[] = [
                'question' => $task->question,
                'task_id' => $task->id,
                'is_correct' => $isCorrect,
            ];

            // Если ответ правильный, добавляем запись о пользователе, который его выполнил
            if ($isCorrect) {
                try {
                    $task->users()->attach(auth()->user()->getKey());
                } catch (\Exception $e) {
                    logger([
                        Route::currentRouteAction(),
                        $e->getMessage(),
                    ]);
                }
            }
        }

        // Возвращаем результаты проверки
        return response()->json(['results' => $results]);
    }
}