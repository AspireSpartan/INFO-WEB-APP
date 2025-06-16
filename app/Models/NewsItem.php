<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsItem extends Model
{
    protected $fillable = ['picture', 'author', 'date', 'title', 'url', 'sponsored', 'views'];

    protected $casts = [
        'sponsored' => 'boolean',
        'date' => 'date',
    ];

    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getPictureUrlAttribute()
    {
        return asset('storage/' . $this->picture);
    }

    public function scopeSponsored($query)
    {
        return $query->where('sponsored', true);
    }
}
