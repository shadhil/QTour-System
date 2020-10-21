<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewMember extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    protected $fillable = [
        'full_name', 'job_type_id', 'email', 'phone_number',
    ];


    public function jobType()
    {
        return $this->belongsTo(CrewJobType::class, 'job_type_id');
    }
}
