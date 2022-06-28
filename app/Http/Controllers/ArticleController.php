<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    //
	public function index(){
		//Method 'allPaginate' is a scope from Model
		$articles = Article::allPaginate(7);
		return view('site.articles.index', compact('articles'));
	}
	
	public function show($slug){
		//Method 'findBySlug' is a scope from Model
		$article = Article::findBySlug($slug);
		//$likes = Article::with('likes');
		$likesAmount = DB::table('article_likes_user')->where('article_id','=',$article->id)->where('like_state','=',1)->get()->count();
		return view('site.articles.show', compact('article','likesAmount'));
	}
	//Laravel will determine 'Tag $tag' as Model, which has 'id'. 
	//Therefore, Laravel finds 'tag' by 'id' if it meets a Model Tag.
	public function allByTag(Tag $tag){
		$articles = $tag->articles()->findByTag(7);
		return view('site.articles.byTag', compact('articles'));
	}
}
