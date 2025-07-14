<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedConcern extends Model
{
    use HasFactory;

    public $fillable = [
        'reporter_name',
        'reporter_email',
        'reporter_phone',
        'reporter_address',
        'concern_date',
        'concern_time',
        'concern_barangay',
        'concern_barangay_details',
        'concern_description',
        'status',
    ];
}
