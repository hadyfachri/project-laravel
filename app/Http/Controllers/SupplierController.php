<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Supplier::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'data'=> Supplier::create([
                'name' => $request->name,
                'contact_info' => $request->contact_info  
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
            'data' => Supplier::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);
        return response()->json([
            'data'=> $supplier->create([
                'name' => $request->name ?? $supplier->name,
                'contact_info' => $request->contact_info ?? $supplier->contact_info 
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
            Supplier::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
