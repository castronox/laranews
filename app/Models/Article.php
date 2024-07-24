<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'titulo', 'tema', 'texto', 'imagen', 'visitas', 'published_at', 'deleted_at', 'created_at', 'updated_at'
    ];
}
