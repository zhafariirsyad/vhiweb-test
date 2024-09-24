<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductInterface;
use App\Models\Category;

class ProductRepository implements ProductInterface
{
    public function all()
    {
        return Product::all();
    }

    public function allWithCategory()
    {
        return Product::with('getCategory')->get();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);
        $product->update($data);

        return $product;
    }

    public function delete($id)
    {
        return Product::destroy($id);
    }

    public function getCategories()
    {
        return Category::all();
    }
}
