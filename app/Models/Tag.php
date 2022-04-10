<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
	
	//
	protected $fillable = ['label'];
	
	public $timestamps = false;
	
	//Many to Many using the pivot table 'article_tag'
	public function articles(){
		return $this->belongsToMany(Article::class);
	}
	
	public function scopeListOfTags($query, $amount){
		return $query->orderBy('id', 'desc')->paginate($amount);
	}
}
