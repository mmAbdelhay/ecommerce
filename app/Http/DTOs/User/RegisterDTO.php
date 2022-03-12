<?php

namespace App\Http\DTOs\User;

use App\Http\DTOs\BaseDTO;

class RegisterDTO implements BaseDTO
{

    public static function collection($request): array
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];
    }
}
