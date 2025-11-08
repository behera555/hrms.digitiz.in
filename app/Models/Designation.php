<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designtion';
    protected $keyType = 'integer';
    protected $fillable = ['designtion_name', 'created_at', 'created_by'];
}
