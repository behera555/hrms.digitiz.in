<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee_pf_details extends Model
{
    use HasFactory;
    protected $table = 'employees_pf_details';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'pf_employee', 'pf_employer', 'created_at', 'created_by'];
}
