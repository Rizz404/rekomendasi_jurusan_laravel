<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SawResult extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'student_id',
        'college_major_id',
        'final_score',
        'rank',
        'recommendation_reason',
        'calculation_date',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function collegeMajor(): BelongsTo
    {
        return $this->belongsTo(CollegeMajor::class, 'college_major_id');
    }
}
