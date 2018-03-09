<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the product.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::published()->paginate(18);
        return view('products', compact('products'));
    }

    /**
     * Display the specified product.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $product = Product::where('slug', $request->product)->firstOrFail();
        return view('product', compact('product'));
    }
}
