<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublicOfficialCaption extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'caption', 'titleColor'];
}
