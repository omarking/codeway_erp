<?php

namespace Database\Seeders;

use App\Models\Statu;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = Statu::create([
            'description' => 'Backlog',
        ]);

        $status = Statu::create([
            'description' => 'Para desarrollo',
        ]);

        $status = Statu::create([
            'description' => 'En curso',
        ]);

        $status = Statu::create([
            'description' => 'Finalizada',
        ]);

        $status = Statu::create([
            'description' => 'Cancelada',
        ]);
    }
}
