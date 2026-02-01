<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddonGroupItem extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        "uuid",
        "addon_group_id",
        "addon_item_id",
        "price",
        "is_active",
        "sort_order",
    ];

    public function group()
    {
        return $this->belongsTo(AddonGroup::class, 'addon_group_id');
    }

    public function addonItem()
    {
        return $this->belongsTo(AddonItem::class);
    }
}
