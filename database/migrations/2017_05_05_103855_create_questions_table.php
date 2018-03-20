<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
        });

        Schema::create('questions_translate', function (Blueprint $row) {
            $row->increments('id');
            $row->string('title', 255);
            $row->text('body');
            $row->unsignedInteger('language_id');
            $row->unsignedInteger('questions_id');
            $row->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $row->foreign('questions_id')->references('id')->on('questions')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::create('partners', function (Blueprint $row) {
            $row->increments('id');
            $row->string('image', 255);
            $row->tinyInteger('active')->default(1)->index();
            $row->timestamps();
        });

        Schema::create('conditions', function (Blueprint $row) {
            $row->increments('id');
            $row->tinyInteger('active')->default(1)->index();
            $row->string('image', 255);
            $row->timestamps();
        });

        Schema::create('conditions_translate', function(Blueprint $row){
            $row->increments('id');
            $row->unsignedInteger('language_id');
            $row->unsignedInteger('conditions_id');
            $row->string('title',255);
            $row->string('subtitle',255);
            $row->foreign('language_id')->references('id')->on('languages')->onDelete('cascade')->onUpdate('cascade');
            $row->foreign('conditions_id')->references('id')->on('conditions')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::drop('questions');
       Schema::drop('questions_translate');
       Schema::drop('partners');
       Schema::drop('conditions');
       Schema::drop('conditions_translate');
    }
}
