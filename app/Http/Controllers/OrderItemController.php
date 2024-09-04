<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => OrderItem::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $orderItem = OrderItem::create([
            'order_id' => $request->order_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => $request->price
        ]);

        return response()->json([
            'data' => $orderItem,
            'status' => 'data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => OrderItem::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderItem = OrderItem::findOrFail($id);
        $orderItem->update([
            'order_id' => $request->order_id ?? $orderItem->order_id,
            'product_id' => $request->product_id ?? $orderItem->product_id,
            'quantity' => $request->quantity ?? $orderItem->quantity,
            'price' => $request->price ?? $orderItem->price
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            OrderItem::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
