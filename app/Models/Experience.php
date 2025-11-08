<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;
    protected $table = 'employees_previous_experience_details';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'company_name', 'job_title', 'date_of_joining', 'date_of_relieving', 'location','description', 'attachment', 'created_at', 'created_by'];
}
