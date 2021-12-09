<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

use Illuminate\Support\Str;

class ArticleFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;
	
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
		// Six words in the sentence looks like: "This example is not bad example." 
		$title = $this->faker->sentence(6, true);
		//1. Replace all spaces with dashes: preg_replace('/\s+/', '-', $title) - "This-example-is-not-bad-example." 
		//2. Laravel helper Str::lower() to lower case - "this-example-is-not-bad-example."
		//3. Laravel helper Str::substr to remove last character - "this-example-is-not-bad-example"
		$slug = Str::substr(Str::lower(preg_replace('/\s+/', '-', $title)), 0, -1);
		
        return [
            'title' => $title,
			'body' => $this->faker->paragraph(100, true),
			'slug' => $slug,
			'img' => 'https://via.placeholder.com/150/d9ce98/000000/?text=Laravel-8',
			'created_at' => $this->faker->dateTimeBetween('-1 years')
        ];
    }
}
