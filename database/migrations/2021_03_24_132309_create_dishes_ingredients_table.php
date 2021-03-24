<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishes_ingredient', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ingredient_id');
            $table->foreign('ingredient_id')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('dishes_id');
            $table->foreign('dishes_id')
                ->references('id')
                ->on('dishes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dishes_ingredients');
    }
}
