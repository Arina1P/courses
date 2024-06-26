<?php

use App\Models\Lesson;
use App\Models\User;
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
        Schema::create('passages', function (Blueprint $table) {
            $table->foreignIdFor(User::class, 'user_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

             $table->foreignIdFor(Lesson::class, 'lesson_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();
        });
    }
};
