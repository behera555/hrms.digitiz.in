<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticeBoard extends Model
{
    use HasFactory;
    protected $table = 'notice_boards';
    protected $keyType = 'integer';
    protected $fillable = ['notice_heading','department','type','notice_details', 'created_at', 'created_by'];
}
