<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interviews extends Model
{
    use HasFactory;
    protected $table = 'interviews';
    protected $keyType = 'integer';
    protected $fillable = ['requisition_id','candidate_name','interview_status','interviewer','interview_type','interview_time','interview_name','interview_link','created_by','updated_by','created_at','updated_at'];
}
