<?php

namespace App\Services\Api\V1\Admin;

use App\Models\ItemSize;
use App\Repositories\Api\V1\Admin\ItemRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ItemService
{

    protected ItemRepository $itemRepository;
    /**
     * Create a new class instance.
     */
    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    // GET ALL ITEMS
    public function getAllItems()
    {
        $items = $this->itemRepository->getAllItems();

        return $items;
    }


    // store item 
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $sizes = $data["sizes"] ?? [];

            unset($data["sizes"]);

            $uuid = Str::uuid()->toString();

            $data["uuid"] = $uuid;

            $item = $this->itemRepository->store($data);

            if (!empty($sizes)) {
                $this->createSize($item->id, $sizes);
            }
            DB::commit();

            return $item->load("sizes");
            return response()->json([
                "success" => true,
                "message" => "Item created successfully.",
                "data" => $item->load("sizes")
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            logger()->error($e);
            throw $e;
        }
    }

    public function getItem($id)
    {
        $item = $this->itemRepository->getItem($id);
        return $item;
    }



    public function createSize($itemId, $data)
    {
        if (!empty($data) && !empty($itemId)) {
            foreach ($data as $size) {
                $uuid = Str::uuid()->toString();
                ItemSize::create([
                    "uuid" => $uuid,
                    "item_id" => $itemId,
                    "name" => $size["name"],
                    "price" => $size["price"],
                    "discount" => $size["discount"] ?? null,
                    "discount_type" => $size["discount_type"] ?? "percentage",
                    "is_active" => $size["is_active"] ?? true,
                ]);
            }
        }
    }

    public function updateItem($id, $data)
    {
        $item = $this->itemRepository->updateItem($id, $data);

        if (!empty($data["sizes"])) {
            $this->updateSizes($id, $data["sizes"]);
        }

        return $item;
    }


    public function updateSizes($itemId, $data)
    {
        if (!empty($itemId)) {
            ItemSize::where('item_id', $itemId)->forceDelete();
            $this->createSize($itemId, $data);
        }
    }


    // DELETE ITEM
    public function deleteItem($id)
    {
        $item = $this->itemRepository->deleteItem($id);
        if ($item) {
            ItemSize::where('item_id', $id)->forceDelete();
        }

        return $item;
    }
}
