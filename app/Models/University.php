<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class University extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'status',
        'city',
        'province',
        'description',
        'website',
        'logo',
        'rating',
        'is_active',
    ];

    public function collegeMajors()
    {
        return $this->belongsToMany(CollegeMajor::class, 'college_major_university');
    }
}
