<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\DTOs\User\OrderDTO;
use App\Http\Requests\User\OrderRequest;
use App\Http\Resources\User\OrderResource;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    private OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {
        $filterData = $request->only('product', 'paid');
        return response()->json(['data' =>
            OrderResource::collection($this->orderRepository->getAllOrdersForAuthUser($filterData))
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OrderRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(OrderRequest $request): \Illuminate\Http\JsonResponse
    {
        $order = $this->orderRepository->createOrder(OrderDTO::collection($request));

        return response()->json([
            'message' => 'Order created successfully',
            'data' => OrderResource::make($order)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Order $order
     * @return OrderResource
     */
    public function show(Order $order): OrderResource
    {
        return OrderResource::make($order);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Order $order): \Illuminate\Http\JsonResponse
    {
        if ($order->user_id != Auth::user()->id)
            return response()->json(['message' => 'Cant delete oder doesnt belong to you'], Response::HTTP_FORBIDDEN);

        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }
}
