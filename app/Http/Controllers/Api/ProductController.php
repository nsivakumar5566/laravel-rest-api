<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $products = Product::with('category')->get();
            return response()->json([
                'data' => $products,
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
                'category_id' => 'required',
                'name' => 'required',
                'price' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validation_error' => $validator->errors(),
                ], 422);
            }

            $product = new Product();
            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->save();

            return response()->json([
                'data' => $product,
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
    public function show(Product $product)
    {
        try {

            $product = Product::with('category')->where('id', $product->id)->first();
            return response()->json([
                'data' => $product,
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
    public function update(Request $request, Product $product)
    {
        try {

            $validator = Validator::make($request->all(), [
                'category_id' => 'required',
                'name' => 'required',
                'price' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'validation_error' => $validator->errors(),
                ], 422);
            }

            $product->category_id = $request->category_id;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->save();

            return response()->json([
                'data' => $product,
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
    public function destroy(Product $product)
    {
        try {

            $product->delete();

            return response()->json([
                'message' => 'Product Deleted Successfully',
            ], 200);

        } catch (\Exception$e) {
            return response()->json([
                'server_error' => $e,
            ], 409);
        }
    }
}
