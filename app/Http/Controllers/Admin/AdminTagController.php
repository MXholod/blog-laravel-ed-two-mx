<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class AdminTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Get a portion of the tags. The 'listOfTags' is a scope method from Tag Model
		$tags = Tag::listOfTags(5);
		$title = "List of tags";
		return view('admin.tags.index', compact('title','tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		$title = "Tag creation";
		return view('admin.tags.create', ['title' => $title]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
		$request->validate([
			'label' => 'required'
		]);
		//Tag label
		$tagLabel = $request->input('label');
		//If validation is successful do mass filling
		Tag::create([
			'label' => $tagLabel
		]);
		//Flash message
		//$request->session()->flash('success', "Tag {$tagLabel} has been added");
		//Flash message another way 'with()' method
		return redirect()->route('admin.tags.index')->with('success', "The '{$tagLabel}' has been added");
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
        $title = "Edit chosen tag";
		//Find a category to edit
		$tag = Tag::find($id);
		
		return view('admin.tags.edit', compact('title','tag'));
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
		$request->validate([
			'label' => 'required'
		]);
		//Tag label
		$tagLabel = $request->input('label');
		//Find a tag to edit
		$tag = Tag::find($id);
		//$tag->slug = null; //If we want to change the slug. Set to null, slug will be changed according to the title
		//Update
		$tag->update(['label' => $tagLabel]);
		
		return redirect()->route('admin.tags.index')->with('success', "The '{$tagLabel}' has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		//Find a tag to edit
		$tag = Tag::find($id);
		//Total articles amount
		$totalArticles = $tag->articles->count();
		//If tag doesn't use any article
		if($totalArticles == 0){
			$tag->delete();
			//$tag->destroy($id); //Delete tag immediately
			return redirect()->route('admin.tags.index')->with('success', "The '{$tag->label}' has been deleted");
		}else{
			//You can't delete these tags they are used with articles
			$tagsStr = $totalArticles == 1 ? 'uses with '.$totalArticles.' article' : 'uses with '.$totalArticles.' articles';
			return redirect()->route('admin.tags.index')->with('error', "The '{$tag->label}' '{$tagsStr}'");
		}
    }
}
