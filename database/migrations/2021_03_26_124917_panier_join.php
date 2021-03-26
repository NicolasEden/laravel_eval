<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PanierJoin extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dishe_paniers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('panier_id');
            $table->foreign('panier_id')
                ->references('id')
                ->on('paniers')
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
        //
    }
}
