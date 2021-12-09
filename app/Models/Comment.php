<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	
	//Accessible fields during mass fillings
	protected $fillable = ['subject', 'body', 'article_id'];
	
	//Inaccessible fields during mass fillings
	//protected $guarded = [];
	
	//One To Many (Inverse). Comment belongs to an Article
	public function article(){
		return $this->belongsTo(Article::class);
	}
}
