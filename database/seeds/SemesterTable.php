<?php

use Illuminate\Database\Seeder;
use App\Semester;

class SemesterTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Semester::create(
            [
                'semester' => '1st',
                'current' => '1'               
            ]
        );

        Semester::create(            
            [
                'semester' => '2nd',
                'current' => '0'               
            ]
        );
    }
}
