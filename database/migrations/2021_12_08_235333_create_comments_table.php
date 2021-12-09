<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
			$table->string('subject');
			$table->text('body');
			/*
			$table->unsignedBigInteger('article_id');
			$table->foreign('article_id')->references('id')->on('article');//'id' is a column in table 'article'
			*/
			//Since Laravel 7 short way instead of two lines above. 
			//When 'article' is deleted MySQL won't block foreign keys because of onDelete('cascade')
			//'articles' - parent table and 'comments' - child table
			$table->foreignId('article_id')->constrained()->onDelete('cascade');
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
        Schema::dropIfExists('comments');
    }
}