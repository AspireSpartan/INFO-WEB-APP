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

    public function scopeSearch($query, $searchTerm)
    {
        if ($searchTerm) {
            return $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'like', '%' . $searchTerm . '%')
                    ->orWhere('site', 'like', '%' . $searchTerm . '%')
                    ->orWhere('scope', 'like', '%' . $searchTerm . '%')
                    ->orWhere('outcome', 'like', '%' . $searchTerm . '%');
            });
        }
        return $query;
    }
}
