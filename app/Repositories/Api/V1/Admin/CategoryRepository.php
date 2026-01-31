<?php

namespace App\Repositories\Api\V1\Admin;

use App\Models\Category;

class CategoryRepository
{
    /**
     * Create a new class instance.
     */
    public function __construct() {}

    // GET ALL CATEGORIES
    public function categoriesWithChildren()
    {
        return Category::get();
    }

    // CREATE CATEGORY
    public function create(array $data)
    {
        return Category::create($data);
    }

    // GET CATEGORY BY ID

    public function getById($id)
    {
        return Category::find($id);
    }

    // UPDATE CATEGORY 
    public function update($id, array $data)
    {
        $category = $this->getById($id);
        if (!$category) {
            return $category;
        }
        $category->update($data);
        return $category;
    }


    public function deleteById($id)
    {
        $category = $this->getById($id);
        if (!$category)
            return false;
        $category->delete();
        return true;
    }
}
