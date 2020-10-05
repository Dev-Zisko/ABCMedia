<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nombre');
            $table->string('categoria');
            $table->text('descripcion');
            $table->float('precio');
            $table->float('preciobs');
            $table->integer('cantidad');
            $table->float('peso')->nullable();
            $table->string('medidas')->nullable();
            $table->string('imagen1',255)->nullable();
            $table->string('imagen2',255)->nullable();
            $table->string('imagen3',255)->nullable();
            $table->integer('id_user')->unsigned();
            $table->foreign('id_user')->references('id')->on('users');
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
        Schema::dropIfExists('products');
    }
}
