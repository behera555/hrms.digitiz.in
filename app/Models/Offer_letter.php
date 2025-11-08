<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer_letter extends Model
{
    use HasFactory;
    protected $table = 'employees_offer_letter';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'employee_name', 'designation', 'address', 'offer_letter_date', 'salary_package','reporting','file', 'created_at', 'created_by'];
}
