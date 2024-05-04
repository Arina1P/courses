<?php

use App\Models\Course;
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
    }
};
