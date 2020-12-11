<?php

namespace Database\Factories;

use App\Models\Vacant;
use Illuminate\Database\Eloquent\Factories\Factory;

class VacantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'          => $this->faker->unique()->sentence(),
            'description'   => $this->faker->text(),
            'quantity'      => rand(1,20),
        ];
    }
}
