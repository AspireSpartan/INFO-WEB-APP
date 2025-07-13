<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KeepInTouch extends Model
{
    protected $fillable = ['title', 'text_content'];

    public function socialLinks()
    {
        return $this->hasMany(SocialLink::class);
    }
}
