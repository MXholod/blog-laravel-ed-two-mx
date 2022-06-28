<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleLikesUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_likes_user', function (Blueprint $table) {
            $table->id();
			/*
			$table->unsignedBigInteger('tag_id');
			$table->foreign('tag_id')->references('id')->on('tags');//'id' is a column in table 'tags'
			*/
			//Since Laravel 7 short way instead of two lines above. 
			//When 'article' is deleted MySQL won't block foreign keys because of onDelete('cascade')
			$table->foreignId('article_id')->constrained()->onDelete('cascade');
			$table->foreignId('user_id')->constrained()->onDelete('cascade');
			$table->tinyInteger('like_state')->default(0);
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
        Schema::dropIfExists('article_likes_user');
    }
}
