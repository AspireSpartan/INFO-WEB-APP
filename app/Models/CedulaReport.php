<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CedulaReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'barangay',
        'residential_address',
        'date_of_birth',
        'place_of_birth',
        'citizenship',
        'civil_status',
        'profession',
        'gross_annual_income',
        'community_tax_due',
        'cedula_declaration_consent',
        'status'
    ];
    
    protected $attributes = [
        'status' => 'pending'
    ];
}