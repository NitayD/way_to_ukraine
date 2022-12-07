<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Fundraising extends Model implements HasMedia
{
    use SoftDeletes;
    use InteractsWithMedia;
    use Auditable;
    use HasFactory;

    public $table = 'fundraisings';

    protected $appends = [
        'files',
        'gallary',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'finished',
        'already_collected',
        'title',
        'description_short',
        'description',
        'donation_link',
        'sort',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function funraisingPurchasingLists()
    {
        return $this->hasMany(PurchasingList::class, 'funraising_id', 'id');
    }

    public function aidContentPages()
    {
        return $this->hasMany(ContentPage::class, 'aid_id', 'id');
    }

    public function getFilesAttribute()
    {
        return $this->getMedia('files');
    }

    public function getGallaryAttribute()
    {
        $files = $this->getMedia('gallary');
        $files->each(function ($item) {
            $item->url = $item->getUrl();
            $item->thumbnail = $item->getUrl('thumb');
            $item->preview = $item->getUrl('preview');
        });

        return $files;
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scopeCollectedSum($query)
    {
        return $query
            ->withSum('funraisingPurchasingLists', 'total_sum');
    }

    public function scopeMain($query)
    {
        return $query
            ->where('finished', false)
            ->collectedSum()
            ->orderby('sort', 'desc')
            ->limit(3);
    }

    public function getProgressAttribute()
    {
        if (!$this->funraising_purchasing_lists_sum_total_sum) {
            $this->funraising_purchasing_lists_sum_total_sum = $this->funraisingPurchasingLists()->sum('total_sum');
        }
        $info = round($this->already_collected/$this->funraising_purchasing_lists_sum_total_sum*100);
        if ($info > 100) $info = 100;
        elseif ($info < 0) $info = 0;
        return $info;
    }
}
