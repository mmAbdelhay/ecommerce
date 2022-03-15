<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    public function createProduct($data)
    {
        return Product::create($data);
    }

    public function getProducts($filterData): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        return Product::filter($filterData)->paginate(10);
    }

    public function updateProduct($product, $data)
    {
        $product->update($data);
        return $product;
    }
}
