<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'deadline',
        'team',
        'progress',
        'priority',
        'status',
        'cost'
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
