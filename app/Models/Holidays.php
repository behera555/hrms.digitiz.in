<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holidays extends Model
{
    use HasFactory;
    protected $table = 'holiday';
    protected $keyType = 'integer';
    protected $fillable = ['holiday_name', 'holiday_date', 'created_at', 'created_by'];
}
