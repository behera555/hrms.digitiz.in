<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssetsAllocate extends Model
{
    use HasFactory;
    protected $table = 'assets_allocate';
    protected $keyType = 'integer';
    protected $fillable = ['asset_name', 'employee_name', 'allocate_date', 'return_date', 'created_at', 'created_by'];
}
