<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blogfeed extends Model
{
    use HasFactory;

    protected $table = 'blogfeed';

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
