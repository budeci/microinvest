<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplication', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('dealer', 255);
            $table->string('session_id', 255);
            $table->enum('status', ['open', 'close'])->default('open');
            $table->timestamps('expire_date');
            $table->timestamps();
        });

        Schema::create('aplication_file', function(Blueprint $table)
        {
            $table->increments('id');
            $table->unsignedInteger('aplication_id')->index();
            $table->string('file', 255);
            $table->string('id_file', 255);
            $table->foreign('aplication_id')->references('id')->on('aplication')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aplication');
        Schema::drop('aplication_file');
    }
}


