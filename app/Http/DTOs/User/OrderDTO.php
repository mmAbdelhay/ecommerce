<?php

namespace App\Http\DTOs\User;

class OrderDTO implements \App\Http\DTOs\BaseDTO
{

    public static function collection($request): array
    {
        return [
          'product_id' => $request->product_id,
          'paid' => $request->paid
        ];
    }
}
