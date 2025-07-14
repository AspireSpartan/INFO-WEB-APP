<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsOffer extends Model
{
    protected $table = 'aboutus_offers';
protected $fillable = ['title', 'description', 'icon'];
    public $timestamps = true;
}