<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayPIsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_p_is', function (Blueprint $table) {
            $table->increments('id');
            $table->string('metodo');
            $table->string('estado');
            $table->string('fecha');
            $table->string('monto');
            $table->integer('id_user')->unsigned();
            $table->integer('id_product')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_product')->references('id')->on('products');
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
        Schema::dropIfExists('pay_p_is');
    }
}
