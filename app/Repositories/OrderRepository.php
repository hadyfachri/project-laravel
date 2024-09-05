<?php

namespace App\Repositories;

use App\Models\Order;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository
{
    protected $model;

    public function __construct(Order $order)
    {
        $this->model = $order;
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
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status
        ]);
    }

    public function update($request, $id)
    {
        $order = $this->model;
        return $order->findOrfail($id)->update([
            'user_id' => $request->user_id ?? $order->user_id,
            'total_price' => $request->total_price ?? $order->total_price,
            'status' => $request->status ?? $order->status
        ]);
        
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }
}
