<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meta', function (Blueprint $table) {
            $table->increments('id');
            $table->string('key');
            $table->string('type')->nullable();
            $table->enum('landing',['general','securitate','intensiv','specialist','manager','logistica']);
            $table->boolean('active')->default(1)->index();
        });

        Schema::create('meta_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('language_id')->unsigned();
            $table->integer('meta_id')->unsigned();
            $table->string('value');
            $table->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('meta_id')->references('id')->on('meta')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('meta_translations');
        Schema::drop('meta');
    }
}
