<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ChangeCategoryStatusRequest;
use App\Http\Resources\User\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }


    public function changeCategoryStatus(ChangeCategoryStatusRequest $request): \Illuminate\Http\JsonResponse
    {
        $order = $this->orderRepository->getOrderById($request->order_id);

        switch ($request->status) {
            case 'approved':
                $order->update(['status' => Order::APROVED]);
                break;
            case 'shipped':
                $order->update(['status' => Order::SHIPPING]);
                break;
            case 'delivered':
                $order->update(['status' => Order::DELIVERD]);
                break;
            default:
                break;
        }

        return response()->json(['message' => 'Order updated successfully', 'data' => OrderResource::make($order)]);
    }
}
