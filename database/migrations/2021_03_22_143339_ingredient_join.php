<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class IngredientJoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredient_join', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('ingredients');
            $table->foreign('ingredients')
                ->references('id')
                ->on('ingredients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('dishes');
            $table->foreign('dishes')
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
        //
    }
}
