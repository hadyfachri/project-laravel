<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    protected $categoryRepository;
    protected $categoryResource;

    public function __construct(CategoryRepository $categoryRepository, CategoryResource $categoryResource)
    {
        $this->categoryRepository = $categoryRepository;
        $this->categoryResource = $categoryResource;
    }

    public function index()
    {
        return response()->json([
            'data' => $this->categoryResource->collection($this->categoryRepository->getAll())]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if($isAdmin)
        {
            return response()->json([
                'data' => $this->categoryRepository->create($request),
                'status' => 'kategori berhasil ditambahkan'
            ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat input category' 
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json([
            'data' => $this->categoryResource->new($this->categoryRepository->getById($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if($isAdmin)
        {
        return response()->json([
            $this->categoryRepository->update($request, $id),
            'status' => 'data berhasil diupdate'
        ]);
        }
        else
        {
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat update category' 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $isAdmin = Auth::user()->role == 'admin';
        if(!$isAdmin)
        {
            return response()->json([
                'status' => 'error',
                'message' => 'hanya admin yang dapat hapus category' 
            ]);
        }
        else
        {
        return response()->json([
            $this->categoryRepository->delete($id),
            'status' => 'data berhasil dihapus'
        ]);
        }
    }
}
