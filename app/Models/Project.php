<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'site',
        'scope',
        'outcome',
        'image_url',
        'url',
    ];
}