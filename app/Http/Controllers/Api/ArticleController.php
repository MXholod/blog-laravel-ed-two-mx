<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Http\Resources\ArticleResource;

use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //
	public function views(Request $request){
		$slug = $request->get('slug');
		$article = Article::findBySlug($slug);
		//
		$statistics = $article->incrementStatistics("views");
		return new ArticleResource($statistics);
	}
	
	public function likes(Request $request){
		$slug = $request->get('slug');
		$userId = $request->get('userId');
		$article = Article::findBySlug($slug);
		
		//Find user and article by id
		$likes = DB::table('article_likes_user')
			->select('like_state')
			->where('article_id', '=', $article->id)
			->where('user_id', '=', $userId)
			->get();
		//If the article has never been liked by the user
		if(count($likes) === 0){
			DB::table('article_likes_user')->insert([
				'article_id' => $article->id,
				'user_id' => $userId,
				'like_state' => 1
			]);
		}else{//The User has already liked an article
			$inverseLike = $likes[0]->like_state == 0 ? 1 : 0;
			DB::table('article_likes_user')
              ->where('article_id', $article->id)
			  ->where('user_id', '=', $userId)
              ->update(['like_state' => $inverseLike]);
		}
		//Count all likes
		$likesAmount = DB::table('article_likes_user')
			->where('article_id', '=', $article->id)
			->where('like_state', '=', 1)
			->get();
		$amount = 0;	
		if(count($likesAmount) > 0){
			foreach($likesAmount as $like){
				$amount += 1;
			}
		}
		
		return new ArticleResource(['likes' => $amount]);
	}
}
