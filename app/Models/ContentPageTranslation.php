<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentPageTranslation extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'excerpt', 'page_text'];

    public $timestamps = false;
}
