<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Cviebrock\EloquentSluggable\Sluggable;

class Article extends Model
{
    use HasFactory;
	use Sluggable;
	
	public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
	
	//Accessible fields during mass fillings
	protected $fillable = ['title', 'body', 'img', 'slug'];
	
	//Inaccessible fields during mass fillings
	//protected $guarded = [];
	
	//One to Many. One article has many comments
	public function comments(){
		return $this->hasMany(Comment::class,'article_id', 'id');
	}
	//One to One
	public function statistics(){
		return $this->hasOne(Statistic::class);
	}
	//Many to Many using the pivot table 'article_tag'
	public function tags(){
		return $this->belongsToMany(Tag::class);
	}
	public function getBodyPreview(){
		//Laravel helper 'limit()' function
		return Str::limit($this->body, 100);
	}
	
	public function createdAtForHumans(){
		//Using PHP Carbon library to work with Date and Time. It is built in Laravel.
		return $this->created_at->diffForHumans();
	}
	
	public function scopeLastLimit($query, $amount){
		//Eager loading 'with' method. Use 'take' or 'limit'
		return $query->with('statistics','tags')->orderBy('created_at','desc')->take($amount)->get();
	}
	
	public function scopeAllPaginate($query, $amount){
		return $query->with('statistics','tags')->orderBy('created_at', 'desc')->paginate($amount);
	}
	
	public function scopeFindBySlug($query, $slug){
		//Method 'firstOrFail' finds first article all invokes an error 
		return $query->with('statistics','tags','comments')->where('slug', $slug)->firstOrFail();
	}
	
	public function scopeFindByTag($query, $amount){
		return $query->with('statistics','tags')->orderBy('created_at', 'desc')->paginate($amount);
	}
	
	public function scopePortionComments($query, $portion = 5){
		return $this->comments()->orderBy('created_at', 'desc')->paginate($portion);
	}
	
	public function scopeIncrementStatistics($query, $entety){
		$stat = $this->statistics;
		$value = 0;
			$value = ($stat->views + 1);
			$this->statistics->update(['views' => $value]);
		return $this->statistics;
	}
	
	//Use this method in View template for a post edit
	public function getImage(){
		//Message is absent
		if(!$this->img){
			return false;
		}
		return asset("downloads/{$this->img}");
	}
	
}
