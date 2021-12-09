<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
	
	//Here we will not use relationship because we always get statistics from an article and never vice versa.
	protected $fillable = ['likes', 'views', 'article_id'];
	
	public $timestamps = false;
}
