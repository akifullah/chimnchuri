<?php

namespace App\Repositories\Api\V1\Admin;

use App\Models\AddonItem;

class AddonItemRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // GET ALL ADDONS

    public function getAll()
    {
        return AddonItem::paginate(15);
    }


    // GET BY ID
    public function getById($id)
    {
        $addonItem = AddonItem::find($id);
        if (!$addonItem) {
            return false;
        }

        return $addonItem;
    }

    // CREATE
    public function create(array $data)
    {
        return AddonItem::create($data);
    }

    // UPDATE
    public function update($id, array $data)
    {
        $addonItem = $this->getById($id);

        if (!$addonItem) {
            return false;
        }

        return $addonItem->update($data);
    }

    // DELETE 
    public function delete($id)
    {
        $addonItem = $this->getById($id);
        if (!$addonItem) {
            return false;
        }

        return $addonItem->forceDelete();
    }
}
