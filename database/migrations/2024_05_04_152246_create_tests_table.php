<?php

use App\Models\Lesson;
use App\Models\Test;
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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
        });

        $javaLesson = Lesson::query()->where('title', 'Введение в Java')->first();

        if ($javaLesson) {
            Test::query()->insert([
                [
                    'title' => 'Введение в Java тест',
                    'lesson_id' => $javaLesson->id,
                ],
            ]);
        }
    }
};
