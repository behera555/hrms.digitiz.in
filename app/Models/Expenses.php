<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;
    protected $table = 'expenses';
    protected $keyType = 'integer';
    protected $fillable = [
    'item_name',
    'price',
    'purchase_date',
    'bill',
    'description',
    'paid_by',
    'aprroval_status',
    'aprroval_statusreason',
    'aprroval_by',
    'created_by',
    'created_at'];
}
