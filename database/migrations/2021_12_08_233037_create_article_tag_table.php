<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		//'article_tag' - is a Pivot table
        Schema::create('article_tag', function (Blueprint $table) {
            //$table->id();
            /*
			$table->unsignedBigInteger('article_id');
			$table->foreign('article_id')->references('id')->on('articles');//'id' is a column in table 'articles'
			*/
			//Since Laravel 7 short way instead of two lines above
			//When 'article' is deleted MySQL won't block foreign keys because of onDelete('cascade')
			$table->foreignId('article_id')->constrained()->onDelete('cascade');
			/*
			$table->unsignedBigInteger('tag_id');
			$table->foreign('tag_id')->references('id')->on('tags');//'id' is a column in table 'tags'
			*/
			//Since Laravel 7 short way instead of two lines above. 
			//When 'article' is deleted MySQL won't block foreign keys because of onDelete('cascade')
			$table->foreignId('tag_id')->constrained()->onDelete('cascade');
			//$table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_tag');
    }
}