<?php

namespace App\Repositories;

use App\Models\Shipping;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class ShippingRepository.
 */
class ShippingRepository
{
    protected $model;

    public function __construct(Shipping $shipping)
    {
        $this->model = $shipping;
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
            'order_id' => $request->order_id,
            'address' => $request->address,
            'shipping_method' => $request->shipping_method,
            'shipping_cost' => $request->shipping_cost,
            'status' => $request->status ?? 'pending',
        ]);
    }

    public function update($request, $id)
    {
        $shipping = $this->model;
        return $shipping->findOrfail($id)->update([
            'address' => $request->address ?? $shipping->address,
            'shipping_method' => $request->shipping_method ?? $shipping->shipping_method,
            'shipping_cost' => $request->shipping_cost ?? $shipping->shipping_cost,
            'status' => $request->status ?? $shipping->status,
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
