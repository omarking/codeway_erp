<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Testing\WithFaker;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = Group::create([
            'name'          => 'Backend',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Frontend',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Marketing',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Q&A',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Testing',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Administración',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Memes',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Dudas',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'General',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Juegos',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Planes',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Consultoria',
            'description'   => $this->faker->sentence,
            'responsable'   => 'Administrador',
        ]);
    }
}
