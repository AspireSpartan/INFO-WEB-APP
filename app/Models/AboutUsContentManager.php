<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutUsContentManager extends Model
{
    protected $table = 'aboutus_content_manager';
    protected $fillable = ['key', 'content'];
    public $timestamps = true;
}