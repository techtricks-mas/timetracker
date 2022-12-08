<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interview extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'name',
        'company',
        'interviewer',
        'role',
        'time',
        'job',
        'url',
        'status',
        'reply',
        'reason',
        'comment',
    ];
}
