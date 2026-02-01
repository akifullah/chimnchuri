<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AddonGroup extends Model
{
    use SoftDeletes, HasFactory;

    protected $fillable = [
        "uuid",
        "item_id",
        "addon_category_id",
        "selection_type",
        "min_qty",
        "max_qty",
        "is_required",
        "is_active",
        "sort_order",
    ];

    public function addonCategory()
    {
        return $this->belongsTo(AddonCategory::class);
    }

    public function items()
    {
        return $this->hasMany(AddonGroupItem::class);
    }
}
