<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use App\Services\ActivityLogService;

class CategoryController extends Controller
{
    protected $categoryService;
    protected $activityLogService;

    public function __construct(
        CategoryService $categoryService,
        ActivityLogService $activityLogService
    ) {
        $this->categoryService = $categoryService;
        $this->activityLogService = $activityLogService;

        /*
        |--------------------------------------------------------------------------
        | Permission
        |--------------------------------------------------------------------------
        */

        $this->middleware('permission:manage categories')->only([
            'create',
            'store',
            'edit',
            'update',
            'destroy',
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = $this->categoryService->getAll();

        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource.
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->store(
            $request->validated()
        );

        $this->activityLogService->log(
            'Category',
            'Menambahkan kategori "' . $category->name . '"'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = $this->categoryService->getById($id);

        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing.
     */
    public function edit(string $id)
    {
        $category = $this->categoryService->getById($id);

        return view('categories.edit', compact('category'));
    }

    /**
     * Update.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = $this->categoryService->update(
            $id,
            $request->validated()
        );

        $this->activityLogService->log(
            'Category',
            'Mengubah kategori "' . $category->name . '"'
        );

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Delete.
     */
    public function destroy(string $id)
    {
        $category = $this->categoryService->getById($id);

        $this->activityLogService->log(
            'Category',
            'Menghapus kategori "' . $category->name . '"'
        );

        $this->categoryService->delete($id);

        return redirect()
            ->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus.');
    }
}