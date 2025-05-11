<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class MajorCharacteristic extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_major_id',
        'criteria_id',
        'compatibility_weight',
        'minimum_score',
    ];

    public function collegeMajor(): BelongsTo
    {
        return $this->belongsTo(CollegeMajor::class, 'college_major_id');
    }

    public function criteria(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_id');
    }

    public function getCompatibilityPercentageAttribute()
    {
        return $this->compatibility_weight * 100 . '%';
    }
}
