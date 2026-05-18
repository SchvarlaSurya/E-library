<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    // Tentukan kolom mana aja yang boleh diisi
    protected $fillable = [
        'title',
        'author',
        'description',
        'cover_url',
        'file_path',
        'category'
    ];
}