<?php

namespace App\Http\DTOs;

interface BaseDTO
{
    public static function collection($request): array;
}
