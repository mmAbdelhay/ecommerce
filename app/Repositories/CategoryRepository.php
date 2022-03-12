<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    public function createCategory($data)
    {
        return Category::create($data);
    }

    public function getAllCategories(): \Illuminate\Database\Eloquent\Collection
    {
        return Category::all();
    }

    public function updateCategory($category, $data)
    {
        Category::update($category, $data);
        return $category;
    }
}
