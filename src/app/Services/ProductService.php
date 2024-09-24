<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function getAllProducts()
    {
        return $this->productRepository->all();
    }

    public function getAllProductsWithCategory()
    {
        return $this->productRepository->allWithCategory();
    }

    public function getProductById($id)
    {
        return $this->productRepository->find($id);
    }

    public function createProduct(array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->productRepository->create($data);
    }

    public function updateProduct($id, array $data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->uploadImage($data['image']);
        }

        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct($id)
    {
        $product = $this->productRepository->find($id);

        if ($product->image) {
            $this->deleteImage($product->image);
        }

        return $this->productRepository->delete($id);
    }

    // Handle image upload
    protected function uploadImage($image)
    {
        $filename = Str::random(10) . '.' . $image->getClientOriginalExtension();

        $image->move(public_path('products'), $filename);
        return $filename;
    }

    // Handle image deletion
    protected function deleteImage($imagePath)
    {
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
    }

    public function getAllCategories()
    {
        return $this->productRepository->getCategories();
    }
}
