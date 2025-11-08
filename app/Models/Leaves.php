<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leaves extends Model
{
    use HasFactory;
    protected $table = 'leave';
    protected $keyType = 'integer';
    protected $fillable = ['type_of_leaves', 'number_of_days', 'created_at', 'created_by'];
}
