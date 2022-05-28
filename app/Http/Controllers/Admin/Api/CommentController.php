<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\CommentResource;
use App\Models\Article;
use App\Models\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
    //Get one comment by ID
	public function getComment($artId){
		$article = Article::find($artId);
		//If article doesn't exist
		if(!$article){
			return response()->json([
				"status" => false,
				"message" => "Article is absent"
			])->setStatusCode(404, "Article is absent");
		}
		if($article->comments->count() == 0){
			return response()->json([
				"status" => true,
				"message" => "Comments are absent",
				"comments" => []
			],200);
		}
		$comments = $article->comments;
		return new CommentResource($comments);
	}
	//Update one comment entirely
	public function updateFullComment(Request $request, $comId){
		$requestData = $request->only(['subject','body','user_id','article_id','user_warning']);
		$validator = Validator::make($requestData, [
            'subject' => ['required', 'string'],
            'body' => ['required', 'string'],
            'user_id' => ['required', 'numeric'],
            'article_id' => ['required', 'numeric'],
            'user_warning' => 'required'
        ]);
		 if ($validator->fails()) {
            return response()->json([
				'status' => false,
				'errors' => $validator->messages()
			])->setStatusCode(422);
        }
		$comment = Comment::find($comId);
		//If comment doesn't exist
		if(!$comment){
			return response()->json([
				"status" => false,
				"message" => "Comment is absent"
			])->setStatusCode(404, "Comment is absent");
		}
		//Rewrite all properties just for testing
		$comment->subject = $comment->subject;
        $comment->body = $comment->body;
        $comment->user_id = $comment->user_id;
        $comment->article_id = $comment->article_id;
		//This property always changes
		$comment->user_warning = $comment->user_warning == 0 ? 1 : 0;
		$comment->save();
		return new CommentResource($comment);
	}
	//Update one comment partially
	public function updatePartComment(Request $request, $comId){
		$comment = Comment::find($comId);
		//If comment doesn't exist
		if(!$comment){
			return response()->json([
				"status" => false,
				"message" => "Comment is absent"
			])->setStatusCode(404, "Comment is absent");
		}
		//This property always changes
		$comment->user_warning = $comment->user_warning == 0 ? 1 : 0;
		$comment->save();
		return new CommentResource($comment);
	}
	//Delete one comment
	public function deletePartComment(Request $request, $comId){
		$comment = Comment::find($comId);
		//If comment doesn't exist
		if(!$comment){
			return response()->json([
				"status" => false,
				"message" => "Comment is absent"
			])->setStatusCode(404, "Comment is absent");
		}
		$comment->delete();
		//Get all the length of 'comments'
		$comment->totalComments = $comment->article->comments->count();
		return new CommentResource($comment);
	}
}
