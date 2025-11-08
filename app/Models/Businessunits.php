<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Businessunits extends Model
{
    use HasFactory;
    protected $table = 'businessunits';
    protected $keyType = 'integer';
    protected $fillable = ['organization_name', 'organization_started_on', 'primary_phone_number', 'secondary_phone_number', 'fax_number', 'country', 'state', 'city', 'currency', 'address', 'org_logo'];
}
