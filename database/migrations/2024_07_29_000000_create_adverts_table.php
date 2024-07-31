<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adverts', function (Blueprint $table) {
            $table->comment('Объявления');
            $table->id();
            $table->string('title')->nullable()->comment('Название');
            $table->text('description')->nullable()->comment('Описание');
            $table->json('images')->nullable()->comment('Ссылки на изображения');
            $table->float('price')->nullable()->comment('Цена');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('adverts');
    }
};
