<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Item extends Model implements HasMedia
{
    use SoftDeletes, HasFactory, InteractsWithMedia;
    protected $fillable = [
        "uuid",
        "name",
        "slug",
        "short_description",
        "description",
        "label",
        "is_taxable",
        "is_discountable",
        "is_active",
        "is_featured",
        "is_popular",
        "sort_order",
    ];

    public $timestamps = false;

    public function sizes()
    {
        return $this->hasMany(ItemSize::class);
    }

    public function categoryItems()
    {
        return $this->hasMany(CategoryItem::class);
    }

    public function categories()
    {
        return $this->hasMany(CategoryItem::class)->with("category");
    }

    public function categories_relation()
    {
        return $this->belongsToMany(Category::class, 'category_items');
    }

    public function addonGroups()
    {
        return $this->hasMany(AddonGroup::class)
            ->where('is_active', true)
            ->orderBy('sort_order');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images')
            ->useDisk('public');
    }


    public function getImagesAttribute()
    {
        return $this->getMedia('images')->map(function ($media) {
            return [
                'id' => $media->id,
                'url' => $media->getUrl(),
                'thumb' => $media->getUrl('thumb'),
                'preview' => $media->getUrl('preview'),
                'name' => $media->file_name,
                'size' => $media->human_readable_size,
            ];
        });
    }

    // Optional: Get first image URL quickly
    public function getFeaturedImageAttribute()
    {
        return $this->getFirstMediaUrl('images');
    }
}
