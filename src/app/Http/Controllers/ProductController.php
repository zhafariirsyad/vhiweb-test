<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function index()
    {
        $products = $this->productService->getAllProductsWithCategory();
        return view('vendor.products.index', [
            'products' => $products,
        ]);
    }

    public function create()
    {
        $categories = $this->productService->getAllCategories();
        return view('vendor.products.create',[
            'categories' => $categories
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $validatedData['vendor_id'] = Auth::guard('vendor')->user()->id;

        $this->productService->createProduct($validatedData);

        return redirect()->route('vendor.products.index')->with('success', 'Product created successfully.');
    }

    public function edit($id)
    {
        $product = $this->productService->getProductById($id);
        $categories = $this->productService->getAllCategories();
        return view('vendor.products.edit', [
            'product' => $product,
            'categories' => $categories
        ]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'weight' => 'required',
            'brand' => 'required',
            'description' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:2048',
        ]);

        $this->productService->updateProduct($id, $validatedData);

        return redirect()->route('vendor.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('vendor.products.index')->with('success', 'Product deleted successfully.');
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        $products = Product::where('name', 'LIKE', "%{$search}%")
            ->orWhereHas('getCategory', function($query) use ($search) {
                $query->where('name', 'LIKE', "%{$search}%");
            })->orWhereHas('vendor', function($query) use ($search) {
                $query->where('company_name', 'LIKE', "%{$search}%");
            })->get();

        return view('search-result', compact('products'))->render();
    }
}
