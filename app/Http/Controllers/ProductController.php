<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Payment;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->productRepository->getAll(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if($isAdmin)
        {
            return response()->json([
                $this->productRepository->create($request),
                'status' => 'data berhasil ditambah' 
        ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat input product' 
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->productRepository->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if($isAdmin)
        {
        return response()->json([
            $this->productRepository->update($request, $id),
            'status' => 'data berhasil diupdate'
        ]);
        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat update product' 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if($isAdmin)
        {
        return response()->json([
            $this->productRepository->delete($id),
            'status' => 'Data berhasil dihapus'
        ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat hapus product' 
            ]);
        }
    }
}
