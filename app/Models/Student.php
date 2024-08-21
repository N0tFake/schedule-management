<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
        'email',
        'course_id',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function disciplines()
    {
        return $this->belongsToMany(Disciplines::class, 'student_discipline')->withTimestamps();
    }
}


