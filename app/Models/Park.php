<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Park extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    protected $fillable = [
        'park_name', 'region_id'
    ];
}
