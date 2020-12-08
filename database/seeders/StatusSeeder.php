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
            'description' => 'En proceso',
        ]);

        $status = Statu::create([
            'description' => 'Pendiente',
        ]);

        $status = Statu::create([
            'description' => 'En desarrollo',
        ]);

        $status = Statu::create([
            'description' => 'Finalizada',
        ]);

        $status = Statu::create([
            'description' => 'Cancelada',
        ]);
    }
}
