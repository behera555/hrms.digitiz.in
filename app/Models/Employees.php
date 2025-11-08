<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;
    protected $table = 'employees_primary_details';
    protected $keyType = 'integer';
    protected $fillable = [
     'emp_id',
    'prefix',
    'first_name',
    'last_name',
    'display_name',
    'gender',
    'date_of_birth',
    'marital_status',
    'blood_group',
    'physically_handicapped',
    'date_of_married',
    'date_of_joining',
    'designation',
    'department',
    'employment_type',
    'reporting_to',
    'profile_pic',
    'created_by',
    'created_at'];


    public function employee_info(){
        return $this->belongsTo(User::class, 'emp_id', 'id');
    }
}
