<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->getAll();

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
        $this->productService->create($validated);

        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = $this->productService->find($id);

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
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->validated();
        $product = $this->productService->update($data, $id);

        return view('product.show', compact('product'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->productService->delete($id);

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
