<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Tag;

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
		return view('site.articles.show', compact('article'));
	}
	//Laravel will determine 'Tag $tag' as Model, which has 'id'. 
	//Therefore, Laravel finds 'tag' by 'id' if it meets a Model Tag.
	public function allByTag(Tag $tag){
		$articles = $tag->articles()->findByTag(7);
		return view('site.articles.byTag', compact('articles'));
	}
}
