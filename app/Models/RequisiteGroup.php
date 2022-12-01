<?php

namespace App\Models;

use \DateTimeInterface;
use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequisiteGroup extends Model
{
    use SoftDeletes;
    use Auditable;
    use HasFactory;

    public $table = 'requisite_groups';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'priority',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function groupRequisites()
    {
        return $this->hasMany(Requisite::class, 'group_id', 'id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
