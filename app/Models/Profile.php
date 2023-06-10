<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'user_id',
        'unit_id',
        'job_position_id',
    ];

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function jobPosition()
    {
        return $this->hasMany(JobPosition::class);
    }

}
