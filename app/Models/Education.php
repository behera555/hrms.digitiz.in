<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;
    protected $table = 'employees_education_details';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'degree', 'specialization', 'year_of_joining', 'year_of_completion', 'cgpa','college', 'attachment', 'created_at', 'created_by'];
}
