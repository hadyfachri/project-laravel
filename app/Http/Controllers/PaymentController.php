<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Models\Payment;
use App\Repositories\PaymentRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected $paymentRepository;

    public function __construct(PaymentRepository $paymentRepository)
    {
        $this->paymentRepository = $paymentRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => PaymentResource::collection($this->paymentRepository->getAll()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request)
    {
        return response()->json([
            $this->paymentRepository->create($request),
            'status' => 'data berhasil ditambah' 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => new PaymentResource($this->paymentRepository->getById($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            $this->paymentRepository->update($request, $id),
            'status' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            $this->paymentRepository->delete($id),
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
