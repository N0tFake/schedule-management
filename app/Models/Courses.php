<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuid;

class Courses extends Model
{
    use HasFactory, hasUuid;

    protected $fillable = [
        'name',
        'coordinator_name',
        'coordinator_email',
    ];

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
