<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
	
	//Accessible fields during mass fillings
	protected $fillable = ['title', 'body', 'img', 'slug'];
	
	//Inaccessible fields during mass fillings
	//protected $guarded = [];
	
	//One to Many. One article has many comments
	public function comments(){
		return $this->hasMany(Comment::class);
	}
	//One to One
	public function statistics(){
		return $this->hasOne(Statistic::class);
	}
	//Many to Many using the pivot table 'article_tag'
	public function tags(){
		return $this->belongsToMany(Tag::class);
	}
}
