<?php

namespace App\Repositories\Api\V1\Admin;

use App\Models\AddonCategory;

class AddonCategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    // GET ALL ADDON CATEGORIES
    public function getAll()
    {
        return AddonCategory::paginate(15);
    }

    // GET BY ID 
    public function getById($id)
    {
        $addonCategory = AddonCategory::find($id);
        if (!$addonCategory) {
            return false;
        }

        return $addonCategory;
    }

    // STORE ADDON CATEGORY

    public function create($data)
    {
        return AddonCategory::create($data);
    }

    // update 
    public function update($id, $data)
    {
        $addonCategory = $this->getById($id);
        if (!$addonCategory) {
            return false;
        }

        $addonCategory->update($data);
        return $addonCategory;
    }

    // DELETE 
    public function delete($id)
    {

        $addonCategory = $this->getById($id);
        if (!$addonCategory) {
            return false;
        }

        return $addonCategory->forceDelete();
    }
}
