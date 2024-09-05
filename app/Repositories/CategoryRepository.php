<?php

namespace App\Repositories;

use App\Models\Category;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class CategoryRepository.
 */
class CategoryRepository
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
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
        return $this->model->create([
            'name' => $request->name,
            'description' => $request->description
        ]);
    }

    public function update($request, $id)
    {
        $category = $this->model;
        return $category->findOrfail($id)->update([
            'name' => $request->name ?? $category->name,
            'description' => $request->description ?? $category->description
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
