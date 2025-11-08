<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $keyType = 'integer';
    protected $fillable = ['login_date', 'login_time', 'logout_date', 'logout_time', 'user_id', 'created_at'];
}
