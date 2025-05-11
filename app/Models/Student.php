<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

// Todo: Implementasiin soft delete
// * Bakal sesuain sama nama tabelnya
// * Langsung connect ke tabel students
class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'NIS',
        'name',
        'gender',
        'school_origin',
        'school_type',
        'school_major',
        'graduation_year',
    ];

    // * Ada return typenya kalo mau
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function studentScores(): HasMany
    {
        return $this->hasMany(StudentScore::class);
    }

    public function sawResults(): HasMany
    {
        return $this->hasMany(SawResult::class);
    }

    const GENDERS = ['man', 'woman'];
    const SCHOOL_TYPES = ['high_school', 'vocational_school'];

    // * Buat ditampilin ke ui
    public function getFormattedSchoolTypeAttribute()
    {
        return [
            'high_school' => 'High School',
            'vocational_school' => 'Vocational School',
        ][$this->school_type] ?? $this->school_type;
    }

    // * Buat ditampilin ke ui
    public function getFormattedGenderAttribute()
    {
        return ucfirst($this->gender);
    }
}
