<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidates extends Model
{
    use HasFactory;
    protected $table = 'candidates';
    protected $keyType = 'integer';
    protected $fillable = ['requisition_id', 'first_name', 'last_name', 'source', 'referal_name', 'email', 'contact_number', 'skill_set', 'resume', 'education_details', 'interview_scheduled', 'employment_status', 'current_company', 'ctc', 'expected_ctc', 'notice_period', 'comments', 'followup', 'created_at', 'created_by'];
}
