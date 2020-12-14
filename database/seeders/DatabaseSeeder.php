<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Event;
use App\Models\Holiday;
use App\Models\Position;
use App\Models\Preuser;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Models\Vacant;
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

        User::factory(49)->create();

        Position::factory(10)->create();

        Profile::factory(50)->create();

        Holiday::factory(50)->create();

        Task::factory(100)->create();

        Project::factory(50)->create();

        Event::factory(50)->create();

        Preuser::factory(50)->create();

        Vacant::factory(10)->create();

        Comment::factory(150)->create();
    }
}
