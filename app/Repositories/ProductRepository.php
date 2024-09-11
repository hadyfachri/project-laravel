<?php

namespace App\Repositories;

use App\Models\Product;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ProductRepository.
 */
class ProductRepository
{
    protected $model;

    public function __construct(Product $product)
    {
        $this->model = $product;
    }

    public function getAll()
    {
        return $this->model->get();
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($request)
    {
        $image = $request->file('image');
        $image?$image->storeAs('/public/storage', $image->hashName()):null;
            return $this->model->create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $request->image ? $image->hashName():null
        ]);
    }

    public function update($request, $id)
    {
        $product = $this->model;
        $isAdmin = $request->user()->where('role', 'admin');
        $image = $request->file('image');
        $image->storeAs('/public/post$post', $image->hashName());
        if($isAdmin)
        {
            return $product->findOrfail($id)->update([
                'data' => $product->create([
                'category_id' => $request->category_id ?? $product->category_id,
                'name' => $request->name ?? $product->name,
                'description' => $request->description ?? $product->description,
                'price' => $request->price ?? $product->price,
                'stock' => $request->stock ?? $product->stock,
                'image' => $image->hashName() ?? $product->image
                ]),
            ]);
        }
        else
        {
            return null;
        }
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
