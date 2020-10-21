<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    public function booker()
    {
        return $this->belongsToMany(User::class, 'admin_id');
    }
}
