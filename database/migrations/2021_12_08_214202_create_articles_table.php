<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            //$table->bigIncrements('id');//AUTO_INCREMENTS, UNSIGNED, BIGINT, PRIMARY KEY
			$table->string('title')->unsigned();
			$table->string('slug')->unsigned();
			$table->text('body');
			$table->string('img');
            $table->timestamps(); //It will create two fields: created_at and updated_at 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
