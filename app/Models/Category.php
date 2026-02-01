<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "uuid",
        "parent_id",
        "level",
        "name",
        "slug",
        "description",
        "image",
        "sort_order",
        "is_active",
        "is_featured",
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
    ];

    public function children()
    {
        return $this->hasMany(Category::class, "parent_id")
            ->where("is_active", true)
            ->orderBy("sort_order");
    }

    public function categoryItems()
    {
        return $this->hasMany(CategoryItem::class);
    }


    public function items()
    {
        return $this->belongsToMany(Item::class, 'category_items')
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    // SCOOPES
    public function scopeActive($query)
    {
        return $query->where("active", true);
    }

    public function scopeRoot($query)
    {
        return $query->whereNull("parent_id");
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy("scope_order");
    }
}
