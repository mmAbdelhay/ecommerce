<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function getAllOrdersForAuthUser(): \Illuminate\Database\Eloquent\Collection
    {
        return Order::where('user_id', Auth::user())->get();
    }

    public function createOrder($data)
    {
        return Order::create($data);
    }
}
