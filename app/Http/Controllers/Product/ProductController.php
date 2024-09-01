<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        Product::create($validated);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        $product->update($data);
        $categories = Category::all();

        return view('product.show', compact('product', 'categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('product.index');
    }

    public function bulk(Request $request)
    {
        $selectedValues = $request->input('arrayData');
        Product::destroy($selectedValues);

        return response()->json(['success' => 'Data deleted successfully.']);
    }

    public function subcategory(Request $request)
    {
        $id = $request->input('data');
        return response()->json([
            'subcategories' => Category::where('parent_id', $id)->get()
        ]);
    }
}
