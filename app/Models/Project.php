<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'category',
        'status',
        'description',
        'image_url',
        'location',
        'year',
        'display_order',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}
