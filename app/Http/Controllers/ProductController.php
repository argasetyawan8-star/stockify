<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ActivityLogService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;
    protected $supplierService;
    protected $activityLogService;

    public function __construct(
        ProductService $productService,
        CategoryService $categoryService,
        SupplierService $supplierService,
        ActivityLogService $activityLogService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
        $this->supplierService = $supplierService;
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{

    $products = $this->productService->getAll(
        $request->search
    );


    return view(
        'products.index',
        compact('products')
    );

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->categoryService->getAllData();
        $suppliers = $this->supplierService->getAllData();

        return view('products.create', compact(
            'categories',
            'suppliers'
        ));
    }

    /**
     * Store a newly created resource.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product = $this->productService->store($data);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Product',
            'activity'   => 'Menambahkan produk "' . $product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load([
            'category',
            'supplier',
            'attributes',
        ]);

        return view('products._show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = $this->productService->getById($id);

        $categories = $this->categoryService->getAllData();
        $suppliers = $this->supplierService->getAllData();

        return view('products.edit', compact(
            'product',
            'categories',
            'suppliers'
        ));
    }

    /**
     * Update the specified resource.
     */
    public function update(ProductRequest $request, string $id)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('products', 'public');
        }

        $product = $this->productService->update($id, $data);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Product',
            'activity'   => 'Mengubah produk "' . $product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $product = $this->productService->getById($id);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Product',
            'activity'   => 'Menghapus produk "' . $product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        $this->productService->delete($id);

        return redirect()
            ->route('products.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}