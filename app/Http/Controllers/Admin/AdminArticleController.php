<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Article;
use App\Models\Tag;

class AdminArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Method 'allPaginate' is a scope from Model
		//$articles = Article::join('comments','articles.id','=','comments.article_id')->get(['articles.title']);
		//$query = "SELECT a.id AS aID, c.id AS cID, a.title, c.subject FROM mx_articles a INNER JOIN mx_comments c ON a.id = c.article_id";
		//$articles = DB::select($query);
		//$articles = Article::allPaginate(5);
		$articles = Article::with('comments')->paginate(5);
		//dump($articles);
		return view('admin.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Get all the tags via Tag Model. 'id' is the key and label is the value of the array
		// pluck - [ 23 => 'Tag label']
		$allTags = Tag::pluck('label', 'id')->all();
		return view('admin.articles.create', compact('allTags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation of parameters
		$request->validate([
			'title' => 'required',
			'body' => 'required',
			//tags[] - is not required
			'img' => 'nullable|image' //nullable - means it is not required
		]);
		$allFields = $request->all();
		//Check if the image file has been loaded
		if($request->hasFile('img')){
			$folderName = date('Y-m-d');	
			//Let's set 'root' => public_path('downloads') - in config/filesystems.php
			//Path to save files: public/downloads/images/2021-08-20
			$allFields['img'] = $request->file('img')->store("images/{$folderName}", 'public');
		}
		//Create an article
		$article = Article::create($allFields);
		//Set tags to the article
		$article->tags()->sync($request->tags);
		//Article title
		$articleTitle = $request->input('title');
		//Flash message another way 'with()' method
		return redirect()->route('articles.index')->with('success', "The '{$articleTitle}' has been added");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}