<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'name',
        'syllabus',
        'course_id',
        'professor_name',
        'professor_email',
    ];

    public function course()
    {
        return $this->belongsTo(Courses::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_discipline')->withTimestamps();
    }
}
