<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->integer('amount')->unsigned();
            $table->integer('stock')->unsigned();
            $table->integer('penanggung_id')->unsigned();
            $table->string('cover')->nullable();
            $table->timestamps();

            $table->foreign('penanggung_id')->references('id')->on('penanggungs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('barangs');
    }
}
