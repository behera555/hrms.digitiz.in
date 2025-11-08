<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allowip extends Model
{
    use HasFactory;
    protected $table = 'allowips';
    protected $keyType = 'integer';
    protected $fillable = ['allowips', 'created_at', 'created_by'];
}
