<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContentCategory extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'content_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'slug',
        'sort',
        'show_main_page',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function pages()
    {
        return $this->belongsToMany(ContentPage::class);
    }

    public function getUrlAttribute()
    {
        return $this->slug ?? $this->id;
    }

    public function scopeMain($query)
    {
        return $query->where('show_main_page', 1)->whereHas('pages', function ($query) {
            return $query->visible();
        })->orderBy('sort', 'desc');
    }
}
