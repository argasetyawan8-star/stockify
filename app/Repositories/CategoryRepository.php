<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::latest()->paginate(10);
    }

    public function getById($id)
    {
        return Category::findOrFail($id);
    }

    public function store(array $data)
    {
        return Category::create($data);
    }

    public function update($id, array $data)
{
    $category = Category::findOrFail($id);

    $category->update($data);

    return $category;
}

    public function delete($id)
    {
        return $this->getById($id)->delete();
    }

    public function getAllData()
{
    return Category::orderBy('name')->get();
}
}
