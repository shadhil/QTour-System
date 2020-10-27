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

    public function permitHolder()
    {
        return $this->belongsToMany(CrewMember::class, 'permit_holder');
    }

    public function crewMembers()
    {
        return $this->belongsToMany(CrewMember::class, 'crew_on_reservations', 'reservation_id', 'member_id');
    }
}
