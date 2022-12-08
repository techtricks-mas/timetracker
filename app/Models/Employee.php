<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'workemail',
        'personalemail',
        'country',
        'phone',
        'role',
        'type',
        'wstart',
        'wend',
        'dhours',
        'whours',
        'designation',
        'jdate',
        'status',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function dailywork() {
        return $this->belongsTo(DailyWork::class);
    }
}
