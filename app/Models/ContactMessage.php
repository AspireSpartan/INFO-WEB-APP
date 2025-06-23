<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contact_messages'; // Ensure this matches your migration table name

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_name',
        'user_email',
        'subject',
        'message',
        'is_read', // If you added this column
    ];

    // Add casts for created_at to easily format it in Blade
    protected $casts = [
        'created_at' => 'datetime',
        'is_read' => 'boolean', // Ensure is_read is cast to boolean
    ];
}