<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pormotion extends Model
{
    use HasFactory;
    protected $table = 'pormotions';
    protected $keyType = 'integer';
    protected $fillable = ['employee_name', 'current_department', 'current_designation', 'current_salary', 'promotion_new_salary', 'promoted_department', 'promoted_designation', 'promotion_date', 'description', 'created_at', 'created_by'];
}
