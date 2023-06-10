<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileCreateValidation;
use App\Http\Requests\UserCreateValidation;
use App\Models\JobPosition;
use App\Models\Profile;
use App\Models\Unit;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $totalEmployees = Profile::count();
        // $loginCounts = Profile::pluck('total_login', 'name');
        $totalUnits = Unit::count();
        $totalJobPositions = JobPosition::count();
        $topEmployees = Profile::orderBy('total_login', 'desc')
            ->paginate($perPage, ['id','name', 'total_login']);

        $topEmployees->each(function ($employee) {
            $employee->jobPosition = $this->getJobPositionByProfileId($employee->id);
        });


        return response()->json([
            'total_employees' => $totalEmployees,
            // 'login_counts' => $loginCounts,
            'total_units' => $totalUnits,
            'total_job_positions' => $totalJobPositions,
            'top_employees' => $topEmployees,
        ]);
    }

    public function getJobPositionByProfileId($profileId)
    {
        $jobPositions = JobPosition::where('profile_id', $profileId)->get();
        return ($jobPositions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
        ]);

        try {
            $profile = Profile::create($validatedData);

            return response()->json(['message' => 'Profile created successfully'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create profile'], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }

    public function countEmployees(Request $request)
    {
        $startDate = Carbon::parse($request->input('start_date'))->startOfDay();
        $endDate = Carbon::parse($request->input('end_date'))->endOfDay();

        $employees = Profile::whereBetween('created_at', [$startDate, $endDate])
            ->where('total_login', '>', 25)
            ->orderBy('total_login', 'desc')
            ->limit(10)
            ->get(['name', 'total_login']);

        $employeeCount = Profile::whereBetween('created_at', [$startDate, $endDate])->count();
        $totalLogins = Profile::whereBetween('created_at', [$startDate, $endDate])->sum('total_login');

        return response()->json([
            'count' => $employeeCount,
            'total_login' => $totalLogins,
            'employees' => $employees
        ]);
    }
}
