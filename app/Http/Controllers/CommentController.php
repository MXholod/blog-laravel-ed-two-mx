<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    //
	public function store(Request $request){
		$validated = $request->validate([
			'comTheme' => 'required|max:5',
			'comText' => 'required',
			'userId' => 'required|numeric',
			'articleId' => 'required|numeric'
		]);
		//Create a comment
		$comment = new Comment;
			$comment->subject = $request->comTheme;
			$comment->body = $request->comText;
			$comment->user_id = $request->userId;
			$comment->article_id = $request->articleId;
		$comment->save();
		
		return back()->with('success','A comment created');
	}
}
