<?php

namespace App\Repositories;

use App\Models\OrderItem;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderItemRepository.
 */
class OrderItemRepository
{
    protected $model;

    public function __construct(OrderItem $orderItem)
    {
        $this->model = $orderItem;
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
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);
    }

    public function update($request, $id)
    {
        return $this->model->findOrfail($id)->update([
            'order_id' => $request->order_id ?? $this->model->order_id,
            'product_id' => $request->product_id ?? $this->model->product_id,
            'quantity' => $request->quantity ?? $this->model->quantity,
            'price' => $request->price ?? $this->model->price
        ]);
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
