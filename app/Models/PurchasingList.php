<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchasingList extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'purchasing_lists';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'funraising_id',
        'item_id',
        'amount',
        'total_sum',
        'sort',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function funraising()
    {
        return $this->belongsTo(Fundraising::class, 'funraising_id');
    }

    public function item()
    {
        return $this->belongsTo(Collectible::class, 'item_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
