<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Inventory::orderBy('created_at', 'asc')->get(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inventory = Inventory::create([
            'supplier_id' => $request->supplier_id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'cost_price' => $request->cost_price,
            'recieved_date' => Carbon::now()
        ]);

        return response()->json([
            'status' => 'data berhasil ditambahkan',
            'data' => $inventory
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->josn([
            'data' => Inventory::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $inventory = Inventory::findOrFail($id);
        $inventory->update([
            'supplier_id' => $request->supplier_id ?? $inventory->supplier_id,
            'product_id' => $request->product_id ?? $inventory->product_id,
            'quantity' => $request->quantity ?? $inventory->quantity,
            'cost_price' => $request->cost_price ?? $inventory->cost_price,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            Inventory::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
