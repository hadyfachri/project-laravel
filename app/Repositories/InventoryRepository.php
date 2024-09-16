<?php

namespace App\Repositories;

use App\Models\Inventory;
use Carbon\Carbon;
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
            'supplier_id'   => $request->supplier_id,
            'product_id'    => $request->product_id,
            'quantity'      => $request->quantity,
            'cost_price'    => $request->cost_price,
            'recieved_date' => Carbon::now(),
        ]);
    }

    public function update($request, $id)
    {
        $inventory = $this->model;
        return $inventory->findOrfail($id)->update([
            'supplied_id' => $request->supplier_id ?? $inventory->supplier_id,
            'product_id' => $request->product_id ?? $inventory->product_id,
            'quantity' => $request->quantity ?? $inventory->quantity,
            'cost_price' => $request->cost_price ?? $inventory->cost_price
            
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
