<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_id',
        'paymentmethod',
        'paymentprice',
        'paymentaddress',
        'status',
    ];
    public function employee()
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }

}