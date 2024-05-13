<?php

use App\Models\Course;
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

        $javaType = Type::query()->where('title', 'Java')->first();

        if ($javaType) {
            Course::query()->insert([
                [
                    'title' => 'Java Course',
                    'description' => 'Описание курса по Java',
                    'price' => 99.99,
                    'period' => 30,
                    'type_id' => $javaType->getKey(),
                ]
            ]);
        }
    }
};
