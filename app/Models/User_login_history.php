<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_login_history extends Model
{
    use HasFactory;
    protected $table = 'user_login_history';
    protected $keyType = 'integer';
    protected $fillable = ['user_id', 'ip','login_time','login_date'];
}
