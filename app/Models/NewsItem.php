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

    public function scopeSearch($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('author', 'like', '%' . $searchTerm . '%')
                    ->orWhere('url', 'like', '%' . $searchTerm . '%');
            });
        }
        return $query;
    }

    public function scopeFilterBySponsored($query, $filter)
    {
        if ($filter != 'all') {
            $isSponsored = ($filter == 'sponsored');
            return $query->where('sponsored', $isSponsored);
        }
        return $query;
    }

    public function scopeSortBy($query, $sortBy)
    {
        switch ($sortBy) {
            case 'date_asc':
                return $query->orderBy('date', 'asc');
            case 'views_desc':
                return $query->orderBy('views', 'desc');
            case 'views_asc':
                return $query->orderBy('views', 'asc');
            case 'date_desc':
            default:
                return $query->orderBy('date', 'desc');
        }
    }
}
