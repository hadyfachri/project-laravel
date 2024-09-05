<?php

namespace App\Repositories;

use App\Models\Supplier;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class SupplierRepository.
 */
class SupplierRepository
{
    protected $model;

    public function __construct(Supplier $supplier)
    {
        $this->model = $supplier;
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
            'contact_info' => $request->contact_info 
        ]);
    }

    public function update($request, $id)
    {
        $supplier = $this->model;
        return $supplier->findOrfail($id)->update([
            'name' => $request->name ?? $supplier->name,
            'contact_info' => $request->contact_info ?? $supplier->contact_info
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
