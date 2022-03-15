<?php

namespace App\Http\DTOs\Admin;

class ProductDTO implements \App\Http\DTOs\BaseDTO
{

    public static function collection($request): array
    {
        return [
            'name' => $request->name,
            'price' => $request->price,
            'stock' => $request->stock,
            'description' => $request->description,
        ];
    }
}
