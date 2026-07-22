<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockOpnameRequest;
use App\Models\Product;
use App\Services\ActivityLogService;
use App\Services\StockOpnameService;

class StockOpnameController extends Controller
{
    protected $stockOpnameService;
    protected $activityLogService;

    public function __construct(
        StockOpnameService $stockOpnameService,
        ActivityLogService $activityLogService
    ) {
        $this->stockOpnameService = $stockOpnameService;
        $this->activityLogService = $activityLogService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $stockOpnames = $this->stockOpnameService->getAll();

        return view('stock-opnames.index', compact('stockOpnames'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::orderBy('name')->get();

        return view('stock-opnames.create', compact('products'));
    }

    /**
     * Store a newly created resource.
     */
    public function store(StockOpnameRequest $request)
    {
        $stockOpname = $this->stockOpnameService->store(
            $request->validated()
        );

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Stock Opname',
            'activity'   => 'Melakukan stock opname produk "' . $stockOpname->product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Stock opname berhasil disimpan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $stockOpname = $this->stockOpnameService->getById($id);

        return view('stock-opnames.show', compact('stockOpname'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        abort(404);
    }

    /**
     * Update the specified resource.
     */
    public function update(StockOpnameRequest $request, string $id)
    {
        abort(404);
    }

    /**
     * Remove the specified resource.
     */
    public function destroy(string $id)
    {
        $stockOpname = $this->stockOpnameService->getById($id);

        $this->activityLogService->store([
            'user_id'    => auth()->id(),
            'module'     => 'Stock Opname',
            'activity'   => 'Menghapus data stock opname produk "' . $stockOpname->product->name . '"',
            'ip_address' => request()->ip(),
        ]);

        $this->stockOpnameService->delete($id);

        return redirect()
            ->route('stock-opnames.index')
            ->with('success', 'Data stock opname berhasil dihapus.');
    }
}