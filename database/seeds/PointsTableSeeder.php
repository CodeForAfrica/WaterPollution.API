<?php

use Illuminate\Database\Seeder;
use App\Point;

class PointsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Let's truncate our existing records to start from scratch.
        Point::truncate();

        // Creating a demo user in our database.
        Point::create([
            'name' => "Point 1",
            'previous_point_id' => "0",
            'next_point_id' => "2"
        ]);

        Point::create([
            'name' => "Point 2",
            'previous_point_id' => "1",
            'next_point_id' => "2"
        ]);

        Point::create([
            'name' => "Point 3",
            'previous_point_id' => "2",
            'next_point_id' => "0"
        ]);
    }
}
