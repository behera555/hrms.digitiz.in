<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applyleaves extends Model
{
    use HasFactory;
    protected $table = 'apply_leave';
    protected $keyType = 'integer';
    protected $fillable = ['emp_id', 'start_date', 'end_date', 'day_type', 'leave_balance', 'reason', 'leave_status', 'leave_status_reason', 'created_at'];
}
