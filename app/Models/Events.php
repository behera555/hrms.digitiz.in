<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'event';
    protected $keyType = 'integer';
    protected $fillable = [
    'event_title',
    'event_date',
    'event_description',
    'created_by',
    'created_at'];
}
