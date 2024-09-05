<?php

namespace App\Repositories;

use App\Models\Inventory;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class InventoryRepository.
 */
class InventoryRepository
{
    protected $model;

    public function __construct(Inventory $inventory)
    {
        $this->model = $inventory;
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
        $inventory = $this->model;
        return $inventory->findOrfail($id)->update([
            'name' => $request->name ?? $inventory->name,
            'description' => $request->description ?? $inventory->description
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
