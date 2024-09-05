<?php

namespace App\Http\Controllers;

use App\Http\Requests\InventoryRequest;
use App\Models\Inventory;
use App\Repositories\InventoryRepository;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventoryRepository;

    public function __construct(InventoryRepository $inventoryRepository)
    {
        $this->inventoryRepository = $inventoryRepository;
    }
    
    public function index()
    {
        return response()->json([
            'data' => $this->inventoryRepository->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InventoryRequest $request)
    {
        return response()->json([
            'status' => 'data berhasil ditambahkan',
            'data' => $this->inventoryRepository->create($request)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->josn([
            'data' => $this->inventoryRepository->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            $this->inventoryRepository->update($request, $id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return response()->json([
            $this->inventoryRepository->delete($id),
            'status' => 'data berhasil dihapus'
        ]);
    }
}
