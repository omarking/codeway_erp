<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;


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
            'description'   => 'Grupo donde solo se ven cosas relacionadas con el Backend',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Frontend',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con el Frontend',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Marketing',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con el Marketing',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Q&A',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con el Q&A',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Testing',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con el Testing',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Administración',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con la Administración',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Memes',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con Memes',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Dudas',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con las Dudas',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'General',
            'description'   => 'Grupo donde solo se ven cosas relacionadas en General',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Juegos',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con los Juegos',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Planes',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con los Planes',
            'responsable'   => 'Administrador',
        ]);

        $groups = Group::create([
            'name'          => 'Consultoria',
            'description'   => 'Grupo donde solo se ven cosas relacionadas con la Consultoria',
            'responsable'   => 'Administrador',
        ]);
    }
}
