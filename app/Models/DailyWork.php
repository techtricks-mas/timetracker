<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailyWork extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'date',
        'project',
        'turl',
        'tdescription',
        'tsdate',
        'tedate',
        'hours',
        'status',
    ];

    public function employee() {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
