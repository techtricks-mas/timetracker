<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cinterview extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'role',
        'time',
        'description',
        'url',
        'status',
        'reason',
        'comment'
    ];
}
