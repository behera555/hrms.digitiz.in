<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Award extends Model
{
    use HasFactory;
    protected $table = 'awards';
    protected $keyType = 'integer';
    protected $fillable = ['award_name', 'employee_name', 'gift_item', 'gift_item_issued_date', 'created_at', 'created_by'];
}
