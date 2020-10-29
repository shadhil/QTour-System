<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCategory extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    protected $fillable = [
        'room_category', 'hotel_id',
    ];
}
