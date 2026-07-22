<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockInRequest;
use App\Models\Product;
use App\Services\StockInService;
use App\Services\ActivityLogService;

class StockInController extends Controller
{
    protected $stockInService;
    protected $activityLogService;

    public function __construct(
        StockInService $stockInService,
        ActivityLogService $activityLogService
    ) {
        $this->stockInService = $stockInService;
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
{

    $search = request('search');


    $stockIns = $this->stockInService
                    ->getAll($search);


    return view('stock-ins.index', compact('stockIns'));

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock-ins.create', compact('products'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(StockInRequest $request)
    {
        $data = $request->validated();

        $product = Product::findOrFail($data['product_id']);

        $stockIn = $this->stockInService->store($data);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Stock In',
            'activity'   => 'Menambahkan Stock In produk "' . $product->name . '" sebanyak ' . $data['qty'],
            'ip_address' => request()->ip(),
        ]);

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stockIn = $this->stockInService->getById($id);

        return view('stock-ins.show', compact('stockIn'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $stockIn = $this->stockInService->getById($id);

        $products = Product::orderBy('name')->get();

        return view('stock-ins.edit', compact(
            'stockIn',
            'products'
        ));
    }

    /**
     * Update the specified resource.
     */
    public function update(StockInRequest $request, string $id)
    {
        $data = $request->validated();

        $product = Product::findOrFail($data['product_id']);

        $stockIn = $this->stockInService->update($id, $data);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Stock In',
            'activity'   => 'Mengubah Stock In produk "' . $product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In berhasil diperbarui.');
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $stockIn = $this->stockInService->getById($id);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Stock In',
            'activity'   => 'Menghapus Stock In produk "' . $stockIn->product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        $this->stockInService->delete($id);

        return redirect()
            ->route('stock-ins.index')
            ->with('success', 'Stock In berhasil dihapus.');
    }
}