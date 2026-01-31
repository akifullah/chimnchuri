<?php

namespace App\Services\Api\V1\Admin;

use App\Models\Category;

use App\Repositories\Api\V1\Admin\CategoryRepository;
use Illuminate\Support\Str;

class CategoryService
{
    protected CategoryRepository $repo;
    public function __construct(CategoryRepository $repo)
    {
        $this->repo = $repo;
    }

    // GET ALL CATEGORIES
    public function getAllCategories()
    {
        return $this->repo->categoriesWithChildren();
    }

    // CREATE CATEGORIES
    public function create(array $data)
    {
        $data['uuid'] = Str::uuid()->toString();
        return $this->repo->create($data);
    }

    // GET CATEGORY BY ID
    public function getById(string $id)
    {
        return $this->repo->getById($id);
    }


    // UPDATE CATEGORY 
    public function updateCategory($id, array $data)
    {
        return $this->repo->update($id, $data);
    }

    // DELETE CATEGORY BY ID
    public function deleteById(string $id)
    {
        return $this->repo->deleteById($id);
    }
}
