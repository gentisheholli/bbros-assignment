<?php

namespace Database\Factories;

use App\Models\ToDo;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ToDo::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $factory->define(App\Models\ToDo::class, function (Faker $faker) {
                return [
                    'title'=> $faker->name,
                    'subtitle'=>$faker->sentence,
                    'description' =>$faker->text,
                    'status'=> shuffle(array(1,3)),
                    'estimated_completion_time'=> $faker->dateTimeBetween($startDate = '-30 years', $endDate = 'now', $timezone = null),
                    'category_id'=>factory('App\Models\ToDoCategory')->create()->id,
                    'user_id' => factory('App\Models\User')->create()->id,
                ];
            });
    }
}
