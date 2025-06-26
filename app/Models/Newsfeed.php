<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Newsfeed extends Model
{
    use HasFactory;

    // Optionally, specify fillable fields
    protected $fillable = [
        'title',
        'content',
        'image_path',
        'icon_path',
        'published_at',
        'author',
        'authortitle',
    ];
}