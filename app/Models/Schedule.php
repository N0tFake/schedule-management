<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory, HasUuid;

    protected $fillable = [
        'day_of_week',
        'start_time',
        'end_time',
        'discipline_id',
    ];

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
