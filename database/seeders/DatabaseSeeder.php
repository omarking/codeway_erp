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
        /*
            Mando llamar a los seeder que he creado

            Estos se encargaran de llenar con algunos datos la base de datos
        */
        $this->call(AbsenceSeeder::class);

        $this->call(ClassSeeder::class);

        $this->call(CategorySeeder::class);

        $this->call(DepartamentSeeder::class);

        $this->call(GroupSeeder::class);

        $this->call(PeriodSeeder::class);

        $this->call(PermissionListSeeder::class);

        $this->call(PrioritySeeder::class);

        $this->call(RolSeeder::class);

        $this->call(StatusSeeder::class);

        $this->call(TypeSeeder::class);

        /*
            Mando llamar a los faker que he creado

            Estos se encargaran de poblar mi base de datos
        */

        \App\Models\User::factory(49)->create();

        \App\Models\Position::factory(10)->create();

        \App\Models\Profile::factory(50)->create();
        
        \App\Models\Holiday::factory(50)->create();

        \App\Models\Task::factory(100)->create();

        \App\Models\Project::factory(50)->create();

        \App\Models\Event::factory(50)->create();

        \App\Models\Preuser::factory(50)->create();

        \App\Models\Vacant::factory(10)->create();

        \App\Models\Comment::factory(150)->create();
    }
}
