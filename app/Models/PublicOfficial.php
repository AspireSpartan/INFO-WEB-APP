<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicOfficial extends Model
{
    protected $table = 'public_officials';

    protected $fillable = [
        'position',
        'name',
        'icon',
        'picture',
    ];
}
