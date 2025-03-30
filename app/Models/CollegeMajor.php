<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class CollegeMajor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'major_name',
        'faculty',
        'description',
        'field_of_study',
        'career_prospects',
        'is_active',
    ];

    public function saw_results(): HasMany
    {
        return $this->hasMany(SawResult::class);
    }

    public function characteristics()
    {
        return $this->hasMany(MajorCharacteristic::class);
    }
}
