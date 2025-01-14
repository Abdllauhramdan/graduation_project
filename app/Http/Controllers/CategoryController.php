<?php

namespace App\Http\Controllers;

use App\Http\Traits\ApiResponseTrait;
use App\Http\Traits\UploadFileTrait;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    use ApiResponseTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    /**
     * Constructor for the CategoryController class.
     *
     * This method sets up the middleware for the controller's methods.
     * It applies specific middleware to specific methods based on permissions.
     *
     * @return void
     */
public function __construct()
    {
        $this->middleware(['permission:create-category'], ['only' => ['store']]);
        $this->middleware(['permission:view-category'], ['only' => ['show']]);
        $this->middleware(['permission:update-category'], ['only' => [ 'update']]);
        $this->middleware(['permission:delete-category'], ['only' => ['destroy']]);
        $this->middleware(['permission:view-categories'], ['only' => ['index']]);
        $this->middleware(['permission:restore-category'], ['only' => ['restore']]);
        $this->middleware(['permission:force-delete-category'], ['only' => ['forceDelete']]);
        }

/**
 * Display a listing of the resource.
 *
 * @throws \Throwable description of exception
 * @return Some_Return_Value
 */
public function index()
{
    try {
        $categories = Category::all();
        return $this->customeResponse(CategoryResource::collection($categories), "Done", 200);
    } catch (\Throwable $th) {
        Log::error($th);
        return $this->customeResponse(null, "Error, Something went wrong", 500);
    }
}


    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(CategoryRequest $request)
    {
    
        try {
            $category = Category::create([
                'name' => $request->name,
            
            ]);
            return $this->customeResponse(new CategoryResource($category), 'Category created successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        try {
            return $this->customeResponse(new CategoryResource($category), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        try {
            $category->name = $request->input('name') ?? $category->name;
            $category->save();
            return $this->customeResponse(new CategoryResource($category), 'Done', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
    
        try {
            $category->delete();
            return $this->customeResponse("", 'category deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "Error, Something went wrong", 500);
        }
    }
    /**
     * Restores a category with the given ID.
     *
     * @param string $id The ID of the category to restore.
     * @return \Illuminate\Http\Response The response containing the restored category, a success message, and a status code.
     * @throws \Throwable If an error occurs while restoring the category.
     */
    public function restore(String $id)
    {
        try {
            $category = Category::withTrashed()->findOrFail($id);
            $category->restore();
            return $this->customeResponse(new CategoryResource($category), 'Category restored successfully', 200);
        } catch (\Throwable $th) {
            Log::error("Error restoring category: " . $th->getMessage());
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }
    
    /**
     * Force delete a category.
     *
     * @param Category $category The category to be force deleted
     * @throws \Throwable description of exception
     * @return Some_Return_Value
     */
    public function forceDelete(Category $category)
    {
        try {
            $category->forceDelete();
            return $this->customeResponse("", 'Category force deleted successfully', 200);
        } catch (\Throwable $th) {
            Log::error($th);
            return $this->customeResponse(null, "There is something wrong in server", 500);
        }
    }
}   



