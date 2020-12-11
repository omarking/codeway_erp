<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'avatar'        => $this->faker->imageUrl(1024, 1024, 'projects', true,'Faker'),
            'key'           => $this->faker->slug,
            'name'          => $this->faker->unique()->sentence,
            'description'   => $this->faker->text,
            'responsable'   => $this->faker->name,
            'clas_id'       => rand(1, 3),
            'category_id'   => rand(1, 10),
        ];
    }
}
