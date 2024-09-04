<?php

namespace App\Http\Controllers;

use App\Models\Shipping;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Shipping::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'data' => Shipping::create([
                'order_id' => $request->order_id,
                'address' => $request->address,
                'shipping_method' => $request->shipping_method,
                'shipping_cost' => $request->shipping_cost,
                'status' => $request->status,
            ]),
            'status' => 'data berhasil ditambahkan'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => Shipping::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $shipping = Shipping::findOrFail($id);
        return response()->json([
            'data' => $shipping->create([
                'address' => $request->address ?? $shipping->address,
                'shipping_method' => $request->shipping_method ?? $shipping->shipping_method,
                'shipping_cost' => $request->shipping_cost ?? $shipping->shipping_cost,
                'status' => $request->status ?? $shipping->status,
            ]),
            'status' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            Shipping::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
