<?php

namespace App\Repositories;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderItemRepository.
 */
class OrderItemRepository
{
    protected $model;
    protected $order;

    public function __construct(OrderItem $orderItem, Order $order)
    {
        $this->model = $orderItem;
        $this->order = $order;
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
        $product = Product::findOrFail($request->product_id);
        $existingOrder = $this->order->where('user_id', $request->user()->id)
                                    ->where('status', 'pending')
                                    ->first();

        if($existingOrder)
        {
        $existingOrder->update([
            'total_price' => $this->order->total_price + ($product->price * $request->quantity)
        ]);

        return $this->model->create([
            'order_id' => $existingOrder->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $product->price * $request->quantity
        ]);
        }
        else
        {
            $newOrder = $this->order->create([
                'user_id' => $request->user()->id,
                'status' => $request->status?:'pending',
                'total_price' => $product->price * $request->quantity
            ]);

            $this->model->create([
                'order_id' => $newOrder->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
                'price' => $product->price * $request->quantity
            ]);
        }
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
