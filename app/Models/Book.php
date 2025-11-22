<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'author', 'publisher', 'publication',
        'price', 'quantity', 'category_id', 'image', 'thumbnail', 'view_count'
    ];
}