<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter_of_intent extends Model
{
    use HasFactory;
    protected $table = 'employees_letter_of_intent';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'employee_name', 'date_of_joining', 'probation_period', 'stipend', 'department_name','file', 'created_at', 'created_by'];
}
