<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUsDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_numbers',
        'email_addresses',
        'contact_address',
    ];
}