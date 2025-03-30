<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Criteria extends Model
{
    use HasFactory, SoftDeletes;
    // * Soalnya table otomatis plural jadi harus diginiin dulu
    // ! udah dibenerin sebagai penanda aja
    protected $table = 'criterias';

    // ! pilih salah satu aja
    // * Whitelist ketika input
    protected $fillable = [
        'name',
        'description',
        'weight',
        'type',
        'school_type',
        'is_active',
    ];

    // * Blacklist ketika input
    // protected $guarded = [
    //     'school_type'
    // ];

    public function student_scores(): HasMany
    {
        return $this->hasMany(StudentScore::class);
    }

    public function major_characteristics(): HasMany
    {
        return $this->hasMany(MajorCharacteristic::class);
    }

    const SCHOOL_TYPES = ['SMA', 'SMK', 'All'];
    const TYPES = ['benefit', 'cost'];
}
