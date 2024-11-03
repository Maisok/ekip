<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('article')->unique();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('color');
            $table->enum('season', ['зима', 'лето', 'осень', 'весна']);
            $table->decimal('price', 8, 2);
            $table->string('sizes'); // Можно использовать JSON для хранения массива размеров
            $table->string('material');
            $table->string('brand');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
