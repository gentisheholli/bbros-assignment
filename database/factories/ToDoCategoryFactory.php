<?php

namespace Database\Factories;

use App\Models\ToDoCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ToDoCategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ToDoCategory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $factory->define(App\Models\ToDoCategory::class, function (Faker $faker) {
            return [
                'name' => $faker->sentence,
                'status' => shuffle(array(0,1)),
                'user_id' => factory('App\Models\User')->create()->id,
            ];
        });
    }
}
