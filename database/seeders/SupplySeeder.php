<?php

namespace Database\Seeders;

use App\Models\Supply;
use Illuminate\Database\Seeder;

class SupplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supply::updateOrCreate([
            'id' => 1,
            'name' => 'Колбаса',
            'quantity' => 300,
            'cost' => 5000,
            'date' => '2021-01-01',
        ]);
        Supply::updateOrCreate([
            'id' => 't-500',
            'name' => 'Пармезан',
            'quantity' => 10,
            'cost' => 6000,
            'date' => '2021-01-02',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-777',
            'name' => 'Левый носок',
            'quantity' => 100,
            'cost' => 500,
            'date' => '2021-01-13',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-778',
            'name' => 'Левый носок',
            'quantity' => 50,
            'cost' => 300,
            'date' => '2021-01-14',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-779',
            'name' => 'Левый носок',
            'quantity' => 77,
            'cost' => 539,
            'date' => '2021-01-20',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-877',
            'name' => 'Левый носок',
            'quantity' => 32,
            'cost' => 176,
            'date' => '2021-01-30',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-977',
            'name' => 'Левый носок',
            'quantity' => 94,
            'cost' => 554,
            'date' => '2021-02-01',
        ]);
        Supply::updateOrCreate([
            'id' => '12-TP-979',
            'name' => 'Левый носок',
            'quantity' => 200,
            'cost' => 1000,
            'date' => '2021-02-05',
        ]);
    }
}
