<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Inventory;
use App\Models\Order;
use App\Repositories\OrderRepository;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => OrderResource::collection($this->orderRepository->getAll()),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        return response()->json([
            $this->orderRepository->create($request),
            'status' => 'data berhasil ditambah' 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => new OrderResource($this->orderRepository->getById($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            $this->orderRepository->update($request, $id),
            'status' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            $this->orderRepository->delete($id),
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
