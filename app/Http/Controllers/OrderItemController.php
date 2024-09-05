<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderItemRequest;
use App\Models\OrderItem;
use App\Repositories\OrderItemRepository;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    protected $orderItemRepository;

    public function __construct(OrderItemRepository $orderItemRepository)
    {
        $this->orderItemRepository = $orderItemRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->orderItemRepository->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            $this->orderItemRepository->create($request),
            'status' => 'data berhasil ditambah' 
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->orderItemRepository->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderItemRequest $request, string $id)
    {
        return response()->json([
            $this->orderItemRepository->update($request, $id),
            'status' => 'data berhasil diupdate'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            $this->orderItemRepository->delete($id),
            'status' => 'Data berhasil dihapus'
        ]);
    }
}
