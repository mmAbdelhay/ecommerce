<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\DTOs\Admin\CategoryDTO;
use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Resources\Admin\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => CategoryResource::collection($this->categoryRepository->getAllCategories())]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param Category $category
     * @return CategoryResource
     */
    public function show(Category $category): CategoryResource
    {
        return CategoryResource::make($category);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryRequest $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $category = $this->categoryRepository->createCategory(CategoryDTO::collection($request));

        return response()->json([
            'message' => 'Category created successfully',
            'data' => CategoryResource::make($category)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $category = $this->categoryRepository->updateCategory($category, CategoryDTO::collection($request));
        return response()->json([
            'message' => 'Category updated successfully',
            'data' => CategoryResource::make($category)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category)
    {
        if (count($category->products) > 0)
            return response()->json(['message' => 'Cant delete category which has products'], Response::HTTP_FORBIDDEN);

        $category->delete();
        return response()->json(['message' => 'Category deleted successfully']);
    }
}
