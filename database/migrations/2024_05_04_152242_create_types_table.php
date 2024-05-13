<?php

use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
        });

        Type::query()->insert([
            [
                'title' => 'Python',
                'description' => 'Python - интерпретируемый высокоуровневый язык программирования общего назначения. Имеет простой и понятный синтаксис, что делает его идеальным выбором для начинающих программистов.',
            ],
            [
                'title' => 'JavaScript',
                'description' => 'JavaScript - скриптовый язык программирования, который используется для создания интерактивных веб-сайтов. Он поддерживается всеми современными браузерами и широко применяется в веб-разработке.',
            ],
            [
                'title' => 'Java',
                'description' => 'Java - мощный и гибкий язык программирования, широко используемый для создания мобильных приложений, веб-приложений, игр и многого другого. Он обладает кроссплатформенностью, что позволяет запускать программы на разных операционных системах без изменений.',
            ],
        ]);
    }
};
