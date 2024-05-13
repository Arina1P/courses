<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(UserController::class)
    ->group(function () {
        Route::post('login', 'login')->name('auth.login');
        Route::post('register', 'register')->name('auth.register');

        Route::middleware(['auth:sanctum'])
            ->group(function () {
                Route::post('logout', 'logout')->name('auth.logout');
            });
    });

Route::controller(CourseController::class)
    ->group(function () {
        // поиск по курсам и типам
        Route::get('/search', 'search')
            ->name('courses.search');

        Route::get('/courses', 'index')
            ->name('courses.index');

        Route::get('/courses/{course}', 'show')
            ->name('courses.show');
    });

Route::middleware(['auth:sanctum'])
    ->controller(LessonController::class)
    ->group(function () {
        Route::get('/lessons/{course}', 'index')
            ->name('lessons.index');

        Route::get('/lessons/lesson/{lesson}', 'show')
            ->name('lessons.show');

        //если человек прошел урок
        Route::post('/lessons/{lesson}', 'passages')
            ->name('lessons.passages');
    });

Route::middleware(['auth:sanctum'])
    ->controller(TestController::class)
    ->group(function () {
        Route::get('/tests/{lesson}', 'index')
            ->name('tests.index');

        Route::get('/tests/test/{test}', 'show')
            ->name('tests.show');
    });

Route::middleware(['auth:sanctum'])
    ->controller(TaskController::class)
    ->group(function () {
        Route::get('/tasks/{test}', 'index')
            ->name('tasks.index');

        Route::get('/tasks/task/{task}', 'show')
            ->name('tasks.show');

        //для проверки одного ответа
        Route::post('/tasks/{task}', 'check')
            ->name('tasks.check');

        //для проверки массива ответов
        Route::post('/tasks', 'checkAll')
            ->name('tasks.checkAll');
    });

