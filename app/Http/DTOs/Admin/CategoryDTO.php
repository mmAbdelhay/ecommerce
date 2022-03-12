<?php

namespace App\Http\DTOs\Admin;

use App\Http\DTOs\BaseDTO;

class CategoryDTO implements BaseDTO
{

    public static function collection($request): array
    {
        return [
            'name' => $request->name,
        ];
    }
}
