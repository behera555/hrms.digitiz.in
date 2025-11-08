<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    use HasFactory;
    protected $table = 'employees_relations_details';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'relation_type', 'gender', 'first_name', 'last_name', 'email','mobile','profession','date_of_birth', 'created_at', 'created_by'];
}
