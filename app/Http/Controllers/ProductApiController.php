<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index()
    {
        $products = Product::with('category','productPrices')->get();
        
        return response()->json([
            'product' => $products
        ], 200);
    }

    public function show(Product $api_product)
    {
        $product = Product::with('category','productPrices')->find($api_product->id);
        return response()->json([
            'message' => "Product Showed Successfully!!",
            'product' => $product
        ], 200);
    }
}
