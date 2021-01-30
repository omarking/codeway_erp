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
            'description' => 'Creada',
        ]);

        $status = Statu::create([
            'description' => 'Desarrollo',
        ]);

        $status = Statu::create([
            'description' => 'Finalizada',
        ]);

        $status = Statu::create([
            'description' => 'Pendiente',
        ]);
    }
}
