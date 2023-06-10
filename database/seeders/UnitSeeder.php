<?php

namespace Database\Seeders;

use App\Models\Unit;
use Carbon\Factory;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
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

        $units = [
            [
                'name' => 'IT Department',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Emergency Department',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Operating Room',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Intensive Care Unit',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Laboratory',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Radiology',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Farmasi',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Rehabilitasi Medik',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Unit Rawat Inap',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Poliklinik',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Kamar Operasi',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
            [
                'name' => 'Unit Perawatan Intensif',
                'updated_at' => $randomTimestamp,
                'created_at'=> $randomTimestamp
            ],
        ];

        Unit::insert($units);
    }
}
