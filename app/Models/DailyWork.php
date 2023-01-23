<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'time',
        'vpn',
        'work',
        'ip',
        'project',
        'turl',
        'tdescription',
        'start',
        'end',
        'hours',
        'running',
        'status',
    ];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'employee_id');
    }
}
