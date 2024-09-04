<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Product::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $image = $request->file('image');
        $image->storeAs('/public/post$post', $image->hashName());
        return response()->json([
            'data' => Product::create([
                'category_id' => $request->category_id,
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'stock' => $request->stock,
                'image' => $image->hashName()
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
            'data' => Payment::findorFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = $request->file('image');
        $image->storeAs('/public/post$post', $image->hashName());
        $payment = Payment::findOrFail($id);
        return response()->json([
            'data' => $payment->create([
                'category_id' => $request->category_id ?? $payment->category_id,
                'name' => $request->name ?? $payment->name,
                'description' => $request->description ?? $payment->description,
                'price' => $request->price ?? $payment->price,
                'stock' => $request->stock ?? $payment->stock,
                'image' => $image->hashName() ?? $payment->image
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
            Payment::findOrFail($id)->delete(),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
