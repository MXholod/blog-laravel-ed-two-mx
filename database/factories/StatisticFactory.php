<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Statistic;

class StatisticFactory extends Factory
{
	/**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Statistic::class;
	
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'likes' => $this->faker->numberBetween($min = 1, $max = 20),
			//21 - 100   - to avoid a situation when 'likes' more than 'views'
			'views' => $this->faker->numberBetween($min = 21, $max = 100)
        ];
    }
}
