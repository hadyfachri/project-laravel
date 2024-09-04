<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Order::get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $request->total_price,
            'status' => $request->status
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => Order::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update([
            'user_id' => $request->user_id ?? $order->user_id,
            'total_price' => $request->total_price ?? $order->total_price,
            'status' => $request->status ?? $order->status
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            Order::findOrFail($id)->delete(),
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
