<?php

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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Test::class, 'test_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();

            $table->text('question');
            $table->text('answer');
        });
    }
};