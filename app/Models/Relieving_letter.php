<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relieving_letter extends Model
{
    use HasFactory;
    protected $table = 'employees_relieving_letter';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'employee_name', 'designation', 'resignation_email_date', 'relieved_date', 'date_of_joining', 'file', 'created_at', 'created_by'];
}
