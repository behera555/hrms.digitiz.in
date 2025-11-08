<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offere_letter extends Model
{
    use HasFactory;
    protected $table = 'employees_offere_letter';
    protected $keyType = 'integer';
    protected $fillable = ['employee_name', 'job_title','salary_amount', 'joining_date', 'hr_name','hr_phone_no','reporting_to','file', 'created_at', 'created_by'];
}
