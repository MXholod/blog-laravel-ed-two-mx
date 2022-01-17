<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
	
	//Accessible fields during mass fillings
	protected $fillable = ['subject', 'body', 'article_id', 'user_id'];
	
	//Inaccessible fields during mass fillings
	//protected $guarded = [];
	
	//One To Many (Inverse). Comment belongs to an Article
	public function article(){
		return $this->belongsTo(Article::class);
	}
	public function createdAtForHumans(){
		//Using PHP Carbon library to work with Date and Time. It is built in Laravel.
		return $this->created_at->diffForHumans();
	}
	//One to One
	public function user(){
		return $this->hasOne(User::class,'id','user_id');
	}
}
