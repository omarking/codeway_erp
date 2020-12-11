<?php

namespace Database\Factories;

use App\Models\Profile;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Profile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'avatar'        => $this->faker->imageUrl(1024, 1024, 'profiles', true, 'Faker'),
            'description'   => $this->faker->sentence(6),
            'birthday'      => $this->faker->date,
            'facebook'      => $this->faker->userName(),
            'instagram'     => $this->faker->userName,
            'github'        => $this->faker->userName,
            'website'       => $this->faker->url,
            'other'         => $this->faker->word,
            'position_id'   => rand(1, 10),
            'user_id'       => rand(1, 50),
        ];
    }
}
