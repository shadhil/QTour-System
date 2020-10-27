<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    protected $fillable = [
        'first_name', 'last_name', 'job_title_id', 'phone_number',
    ];

    public function jobType()
    {
        return $this->belongsTo(CrewJobType::class, 'job_title_id');
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class, 'crew_on_reservations', 'member_id', 'reservation_id')->withPivot('start_date', 'end_date');
    }

    public function asHolder()
    {
        return $this->hasMany(Reservation::class, 'permit_holder');
    }
}
