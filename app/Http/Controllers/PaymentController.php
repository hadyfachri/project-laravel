<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Payment::get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            'data' => Payment::create([
                'order_id' => $request->order_id,
                'amount' => $request->amount,
                'payment_method' => $request->payment_method,
                'status' => $request->status,
                'transaction_date' => Carbon::now(),
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
            'data' => Payment::findOrFail($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::findOrFail($id);
        return response()->json([
            'data' => $payment->update([
                'order_id' => $request->order_id ?? $payment->order_id,
                'amount' => $request->amount ?? $payment->amount,
                'payment_method' => $request->payment_method ?? $payment->payment_method,
                'status' => $request->status ?? $payment->status,
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
            'status' => 'data berhasil dihapus;'
        ]);
    }
}
