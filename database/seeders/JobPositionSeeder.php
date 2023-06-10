<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use Illuminate\Database\Seeder;
use Faker\Factory as FakerFactory;

class JobPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        $startDate = '2023-05-01 00:00:00';
        $endDate = '2023-06-30 23:59:59';

        $randomTimestamp = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');

        $jobPositions = [
            [
                'name' => 'Software Engineer',
                'created_at' => $randomTimestamp,
                'profile_id' => 1
            ],
            [
                'name' => 'Software Engineer',
                'created_at' => $randomTimestamp,
                'profile_id' => 2
            ],
            [
                'name' => 'Doctor',
                'created_at' => $randomTimestamp,
                'profile_id' => 2
            ],
            [
                'name' => 'Nurse',
                'created_at' => $randomTimestamp,
                'profile_id' => 3
            ],
            [
                'name' => 'Pharmacist',
                'created_at' => $randomTimestamp,
                'profile_id' => 4,
            ],
            [
                'name' => 'Medical Technologist',
                'created_at' => $randomTimestamp,
                'profile_id' => 5
            ],
            [
                'name' => 'Radiographer',
                'created_at' => $randomTimestamp,
                'profile_id' => 6
            ],
        ];

        JobPosition::insert($jobPositions);
    }
}
