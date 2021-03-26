<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->float('price');
            $table->string("libelle")->unique();
            $table->float("weight");

            $table->unsignedBigInteger("dishes_origines");
            $table->foreign('dishes_origines')
                ->references('id')
                ->on('dishes_origines')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger("dishes_type_food");
            $table->foreign('dishes_type_food')
                ->references('id')
                ->on('dishes_type_food')
                ->onDelete('restrict')
                ->onUpdate('restrict');

            $table->unsignedBigInteger("dishes_types");
            $table->foreign('dishes_types')
                ->references('id')
                ->on('dishes_types')
                ->onDelete('restrict')
                ->onUpdate('restrict');
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
        Schema::dropIfExists('dishes');
    }
}
