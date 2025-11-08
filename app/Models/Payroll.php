<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payroll extends Model
{
    use HasFactory;
    protected $table = 'payroll_structure';
    protected $keyType = 'integer';
    protected $fillable = ['basic_salary', 'hra_allowance', 'education', 'lta','travel_allowances','communication','special_allowance','professional_tax','updated_at','updated_by'];
}
