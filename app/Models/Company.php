<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    protected $connection = 'app_db';
    use HasFactory, SoftDeletes;


    protected $fillable = [
        'name', 'email', 'phone_number'
    ];
}
