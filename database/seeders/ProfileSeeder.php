<?php

namespace Database\Seeders;

use App\Models\JobPosition;
use App\Models\Profile;
use App\Models\Unit;
use App\Models\User;
use Carbon\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $listUnits = Unit::all();
        $listJobPositions = JobPosition::all();

        $shuffledUnitIds = $listUnits->pluck('id')->shuffle();
        $shuffledJobPositionIds = $listJobPositions->pluck('id')->shuffle();

        for ($i = 1; $i <= 10; $i++){
            $randomNumJob = rand(1,5);
            $randomNumLog = rand(100,200);

            User::create([
                'id' => $i,
                'name' => 'Staff'. $i,
                'email' => 'Staff'. $i.'@puri-bunda.id',
                'password' => Hash::make('password123'),
            ]);

            Profile::create([
                'id'=> $i,
                'name' => 'Staff'. $i,
                'user_id' => $i,
                'unit_id' => $shuffledUnitIds[$randomNumJob],
                'job_position_id' => $shuffledJobPositionIds[$randomNumJob],
                'total_login' => $randomNumLog
            ]);
        }
    }
}
