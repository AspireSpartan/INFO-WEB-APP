<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SectionBanner extends Model
{
    use HasFactory;
    
    
    protected $fillable = [
        'background_image',
        'header1',
        'header2',
        'header3',
        'header4',
        'description',
        'barangay',
        'residents',
        'projects',
        'yrs_service',
    ];

    protected $casts = [
        'barangay' => 'integer',
        'residents' => 'integer',
        'projects' => 'integer',
        'yrs_service' => 'integer',
    ];

     
}
