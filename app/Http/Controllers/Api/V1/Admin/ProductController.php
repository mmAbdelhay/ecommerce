<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\ProductDTO;
use App\Http\Requests\Admin\ProductRequest;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $ProductRepository)
    {
        $this->productRepository = $ProductRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        $filterData = $request->only('name', 'description', 'price', 'category', 'from_price', 'to_price');
        return response()->json([
            'data' => ProductResource::collection($this->productRepository->getProducts($filterData))
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductRequest $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $product = $this->productRepository->createProduct(ProductDTO::collection($request));

        return response()->json([
            'message' => 'Category created successfully',
            'data' => ProductResource::make($product)
        ], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return ProductResource
     */
    public function show(Product $product): ProductResource
    {
        return ProductResource::make($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $product = $this->productRepository->updateProduct($product, ProductDTO::collection($request));

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => ProductResource::make($product)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        if (count($product->orders) > 0)
            return response()->json(['message' => 'Cant delete product which has orders'], Response::HTTP_FORBIDDEN);

        $product->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
