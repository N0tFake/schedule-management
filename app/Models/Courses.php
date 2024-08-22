<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Courses extends Model
{
    use HasFactory, hasUuids;

    protected $fillable = [
        'name',
        'coordinator_id'
    ];

    public function coordinator()
    {
        return $this->belongsTo(User::class, 'coordinator_id');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
