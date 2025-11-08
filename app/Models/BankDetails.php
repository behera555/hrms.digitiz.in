<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankDetails extends Model
{
    use HasFactory;
    protected $table = 'employees_bank_details';
    protected $keyType = 'integer';
    protected $fillable = ['bank_name', 'bank_ifsc', 'bank_account', 'pan', 'uan', 'pf_number', 'created_at', 'updated_at', 'created_by'];
}
