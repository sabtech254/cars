<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price', 12, 2);
            $table->text('description');
            $table->string('condition'); // new, used
            $table->string('transmission');
            $table->string('fuel_type');
            $table->integer('mileage')->nullable();
            $table->string('body_type');
            $table->string('color');
            $table->boolean('is_featured')->default(false);
            $table->string('status')->default('available'); // available, sold, pending
            $table->json('features')->nullable();
            $table->json('images');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('cars');
    }
};
