<?php

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lessons', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->integer('period'); //количество часов для прохождения

            $table->foreignIdFor(Course::class, 'course_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();
        });

        $javaCourse = Course::query()->where('title', 'Java Course')->first();

        if ($javaCourse) {
            Lesson::query()->insert([
                [
                    'title' => 'Введение в Java',
                    'content' => 'Краткое введение в язык программирования Java.',
                    'period' => 2, // Примерное количество часов для прохождения
                    'course_id' => $javaCourse->id,
                ],
                [
                    'title' => 'Основы синтаксиса Java',
                    'content' => 'Основные правила и конструкции языка Java.',
                    'period' => 4,
                    'course_id' => $javaCourse->id,
                ],
                [
                    'title' => 'Объектно-ориентированное программирование в Java',
                    'content' => 'Принципы ООП и их применение в Java.',
                    'period' => 6,
                    'course_id' => $javaCourse->id,
                ],
            ]);
        }
    }
};
