<?php

use Illuminate\Database\Seeder;
use App\Statistic;

class StatisticsTaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Statistic::truncate();

        // Creating a demo user in our database.
        Statistic::create([
            'point_id' => "1",
            'cholera_level' => "0.5"
        ]);

        Statistic::create([
            'point_id' => "2",
            'cholera_level' => "0.2"
        ]);

        Statistic::create([
            'point_id' => "3",
            'cholera_level' => "0.7"
        ]);
    }
}
