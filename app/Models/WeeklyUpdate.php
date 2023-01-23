<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyUpdate extends Model
{
    use HasFactory;

    protected $fillable = ['done', 'priorities', 'concerns', 'summary', 'date'];

    public function employee()
    {
        return $this->hasOne(Employee::class, 'user_id', 'employee_id');
    }
}
