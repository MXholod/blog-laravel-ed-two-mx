<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCommentsAddColumnUserId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
			$table->unsignedBigInteger('user_id')->after('body');
			$table->foreign('user_id')->references('id')->on('users');//'id' is a column in table 'users'
			//Since Laravel 7 short way instead of two lines above. 
			//When 'article' is deleted MySQL won't block foreign keys because of onDelete('cascade')
			//'users' - parent table and 'comments' - child table
			//$table->foreignId('user_id')->constrained()->onDelete('cascade')->after('body');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('comments', function (Blueprint $table) {
            //
			$table->dropForeign('mx_comments_user_id_foreign');
			$table->dropColumn('user_id');
        });
    }
}
