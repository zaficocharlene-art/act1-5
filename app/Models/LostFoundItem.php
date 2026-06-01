<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LostFoundItem extends Model
{
    protected $fillable = [
        'type',
        'title',
        'description',
        'category',
        'location',
        'date',
        'image_url',
        'contact_name',
        'contact_email',
        'contact_phone',
        'status',
        'reward',
    ];
    protected $casts = [
        'date' => 'date',
    ];
}