<?php

namespace App\Http\Controllers\Manager;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $products = Product::published()->paginate(18);
        return view('manager.products', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('manager.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request\StoreProductRequest  $request
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function store(StoreProductRequest $request)
    {
        try {
            $product = new Product;

            $product->title = $request->name;
            $product->slug = $request->slug;
            $product->image = $request->image;
            $product->barcode = $request->barcode;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->published = ($request->published) ? true : false;
            $product->user_id = auth()->user()->id;

            $product->save();
            
            return redirect()->route('manager.show_product', ['id' => $product->id]);
        } catch (Exception $e) {
            report($e);
            return redirect()->back()->with('error', 'Oops! There was an error inserting the product. Try again later.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\View\View
     */
    public function show(Request $request, Product $product)
    {
        return view('manager.product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\View\View
     */
    public function edit(Product $product)
    {
        return view('manager.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateProductRequest $request
     * @param \App\Product $product
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        try {
            $product->title = $request->name;
            $product->slug = $request->slug;
            $product->image = $request->image;
            $product->barcode = $request->barcode;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->published = ($request->published) ? true : false;
            $product->user_id = auth()->user()->id;

            $product->save();

            return redirect()->route('manager.show_product', ['id' => $product->id])->with('success', 'Success! The product has been updated successfully.');
        } catch (Exception $e) {
            report($e);
            return redirect()->back()->with('Error', 'Oops! There was an error updating the product. Try again later.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Support\Facades\Redirect
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();
            return redirect()->route('manager.list_products')->with('success', 'Success! The product has been deleted successfully.');
        } catch (Exception $e) {
            report($e);
            return redirect()->back()->with('Error', 'Oops! There was an error deleting the product. Try again later.');
        }
    }

    /**
     * Display a listing of the drafts resource.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function drafts(Request $request)
    {
        $products = Product::unpublished()->paginate(18);
        return view('manager.drafts', compact('products'));
    }
}
