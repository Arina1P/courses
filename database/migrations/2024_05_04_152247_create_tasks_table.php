<?php

use App\Models\Task;
use App\Models\Test;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class, 'test_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->text('question');
            $table->text('answer');
            $table->jsonb('variants');
        });

        $javaTest = Test::query()->where('title', 'Введение в Java тест')->first();

        Task::query()->insert([
            [
                'test_id' => $javaTest->id,
                'question' => 'Как создать переменную в Java?',
                'answer' => 'Ключевое слово "int" или другой тип данных, за которым следует имя переменной.',
                'variants' => json_encode(['Ключевое слово "int" или другой тип данных, за которым следует имя переменной;', 'String name;', 'double y;']),
            ],
            [
                'test_id' => $javaTest->id,
                'question' => 'Что такое JVM в Java?',
                'answer' => 'Это виртуальная машина, которая выполняет байт-код Java.',
                'variants' => json_encode(['Это виртуальная машина, которая выполняет байт-код Java.', 'Java Visual Machine', 'Java Virtual Machine']),
            ],
        ]);
    }
};
