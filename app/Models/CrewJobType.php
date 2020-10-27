<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrewJobType extends Model
{
    protected $connection = 'company_db';
    use HasFactory;

    public function crewMembers()
    {
        return $this->hasMany(CrewMembers::class, 'job_title_id');
    }
}
