<?php

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
        Schema::create('tests', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->string('title');
        });
    }
};
