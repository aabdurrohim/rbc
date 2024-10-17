<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_name',
        'author',
        'desc',
        'publisher',
        'isbn',
        'stock',
        'interest',
        'image',
        'book_code',
    ];
}
