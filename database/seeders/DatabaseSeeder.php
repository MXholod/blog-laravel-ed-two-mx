<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
		
		//Collection of 10 Tags has been created
		$tags = \App\Models\Tag::factory(10)->create();
		//Collection of 15 Articles has been created
		$articles = \App\Models\Article::factory(15)->create();
		//Each Laravel collection has pluck() method. 
		//Pass a field name into it, which value will be stored in array from collection. We store all tags 'id's in array
		$tags_id = $tags->pluck('id');
		
		$articles->each(function($article) use ($tags_id){
			// Here we add random 'tag_id' to the article
			$article->tags()->attach($tags_id->random(3));
			// For each article create 3 comments
			\App\Models\Comment::factory(3)->create([
				'article_id' => $article->id
			]);
			// For each article create 1 statistic
			\App\Models\Statistic::factory(1)->create([
				'article_id' => $article->id
			]);
		});
		//As a result we have 10 Tags 15 Articles.
		//For each Article we have relationship with 3 Tags
		//Article will have 3 comments
		//Article will have 1 statistic
    }
}
