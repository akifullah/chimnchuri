<?php

namespace App\Repositories\Api\V1\Admin;

use App\Models\CategoryItem;
use App\Models\Item;

class ItemRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }


    public function getAllItems()
    {
        $items = Item::orderBy("id", "desc")->paginate(15);
        return $items;
    }

    // STORE ITEM
    public function store(array $data)
    {
        $item =  Item::create($data);

        if ($item && !empty($data["category_id"])) {
            $this->createCategoryItem([
                "category_id" => (int) $data["category_id"],
                "item_id" => (int) $item->id,
            ]);
        }
        return $item;
    }

    public function getItem($id)
    {
        $item = Item::find($id);

        if (!$item) {
            return false;
        }

        return $item;
    }

    public function updateItem($id, array $data)
    {
        $item = $this->getItem($id);

        if (!$item) {
            return false;
        }

        $updateditem = $item->update($data);

        if ($item && !empty($data["category_id"])) {
            $this->updateCategoryItem([
                "category_id" => (int) $data["category_id"],
                "item_id" => (int) $item->id
            ]);
        }

        return $updateditem;
    }

    // DELETE ITEM
    public function deleteItem($id)
    {
        $item = $this->getItem($id);
        if (!$item) {
            return false;
        }
        return $item->forceDelete();
    }


    public function createCategoryItem($data)
    {

        $categoryItem = CategoryItem::create($data);

        return $categoryItem;
    }

    public function updateCategoryItem(array $data)
    {
        return CategoryItem::updateOrCreate(
            ['item_id' => $data['item_id']],
            ['category_id' => $data['category_id']]
        );
    }
}
