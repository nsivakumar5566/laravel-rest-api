<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $categories = Category::all();
            return response()->json([
                'data' => $categories,
            ], 200);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validation_error' => $validator->errors(),
                ], 422);
            }

            $category = new Category();
            $category->name = $request->name;
            $category->save();

            return response()->json([
                'data' => $category,
            ], 201);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        try {

            return response()->json([
                'data' => $category,
            ], 200);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validation_error' => $validator->errors(),
                ], 422);
            }

            $category->name = $request->name;
            $category->save();

            return response()->json([
                'data' => $category,
            ], 201);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {

            $category->delete();

            return response()->json([
                'message' => 'Category Deleted Successfully',
            ], 200);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }
}
