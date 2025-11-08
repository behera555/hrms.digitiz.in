<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recruitments extends Model
{
    use HasFactory;
    protected $table = 'recruitment';
    protected $keyType = 'integer';
    protected $fillable = ['requisition_code','job_title','position','no_of_positions','job_description','required_skills','required_qualification','required_experience_range','employment_status','priority','due_date','recruitment_status', 'created_at', 'created_by'];
}
