<?php

namespace App\Repositories;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderRepository
{
    public function getAllOrdersForAuthUser($filterData): \Illuminate\Database\Eloquent\Collection
    {
        return Order::where('user_id', Auth::user())->filter($filterData)->get();
    }

    public function createOrder($data)
    {
        return Order::create($data);
    }
}
