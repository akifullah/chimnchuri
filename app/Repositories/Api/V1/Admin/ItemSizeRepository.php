<?php

namespace App\Repositories\Api\V1\Admin;

use App\Models\ItemSize;
use Illuminate\Support\Str;

class ItemSizeRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // STORE SIZE 
    public function store(array $data)
    {

        if (isset($data['sizes']) && is_array($data['sizes']) && count($data['sizes'])) {
            $created = [];
            foreach ($data['sizes'] as $size) {
                $uuid = Str::uuid()->toString();

                $created[] = ItemSize::create([
                    "uuid" => $uuid,
                    "item_id" => $size["item_id"],
                    "name" => $size["name"],
                    "price" => $size["price"],
                    "discount" => $size["discount"] ?? null,
                    "discount_type" => $size["discount_type"] ?? "percentage",
                    "is_active" => $size["is_active"] ?? true,
                    "serves" => $size["serves"] ?? null,
                ]);
            }
            return $created;
        }

        // Single create fallback, if needed
        if (
            isset($data['item_id'], $data['name'], $data['price'])
        ) {
            $uuid = Str::uuid()->toString();
            $data['uuid'] = $uuid;

            return ItemSize::create([
                "uuid" => $data["uuid"],
                "item_id" => $data["item_id"],
                "name" => $data["name"],
                "price" => $data["price"],
                "discount" => $data["discount"] ?? null,
                "discount_type" => $data["discount_type"] ?? "percentage",
                "is_active" => $data["is_active"] ?? true,
                "serves" => $data["serves"] ?? null,
            ]);
        }

        // If neither condition matched, optionally throw or return false/null
        return null;
    }


    public function getById($id)
    {
        $size = ItemSize::find($id);
        if (!$size) {
            return false;
        }
        return $size;
    }


    public function update($id, array $data,)
    {
        $size = $this->getById($id);

        if (!$size) {
            return false;
        }

        return $size->update($data);
    }

    // DELETE SIZE
    public function delete($id)
    {
        $size = $this->getById($id);
        if (!$size) {
            return false;
        }
        return $size->forceDelete();
    }
}
