<?php

namespace App\Http\DTOs;

class LoginDTO implements BaseDTO
{

    public static function collection($request): array
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }
}
