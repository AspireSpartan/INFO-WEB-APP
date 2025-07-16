<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessPermit extends Model
{
    protected $table = 'business_permits';

    protected $fillable = [
        'business_name',
        'business_type',
        'business_barangay',
        'business_address',
        'business_phone',
        'business_email',
        'owner_first_name',
        'owner_last_name',
        'owner_address',
        'owner_phone',
        'owner_email',
        'business_activity',
        'capitalization',
        'status'
    ];

    protected $casts = [
        'capitalization' => 'decimal:2',
    ];
}