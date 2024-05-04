<?php

use App\Models\Type;
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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->float('price');
            $table->integer('period');

            $table->foreignIdFor(Type::class, 'type_id')
                ->nullable()
                ->index()
                ->constrained()
                ->cascadeOnDelete();
        });
    }
};
