<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price', 12, 2);
            $table->integer('mileage');
            $table->string('condition');
            $table->string('transmission');
            $table->string('fuel_type');
            $table->string('engine_size');
            $table->string('color');
            $table->text('description');
            $table->json('features');
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['for_sale', 'sold', 'bidding'])->default('for_sale');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cars');
    }
};