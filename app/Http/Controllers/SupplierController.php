<?php

namespace App\Http\Controllers;

use App\Http\Requests\SupplierRequest;
use App\Services\SupplierService;
use App\Services\ActivityLogService;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    protected $supplierService;
    protected $activityLogService;

    public function __construct(
        SupplierService $supplierService,
        ActivityLogService $activityLogService
    ) {
        $this->supplierService = $supplierService;
        $this->activityLogService = $activityLogService;

        /*
        |--------------------------------------------------------------------------
        | Permission
        |--------------------------------------------------------------------------
        */

        $this->middleware('permission:manage suppliers')->only([
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
    public function index(Request $request)
{

    $suppliers = $this->supplierService->getAll(
        $request->search
    );


    return view(
        'suppliers.index',
        compact('suppliers')
    );

}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $supplier = $this->supplierService->store(
            $request->validated()
        );

        $this->activityLogService->log(
            'Supplier',
            'Menambahkan supplier "' . $supplier->name . '"'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = $this->supplierService->getById($id);

        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = $this->supplierService->getById($id);

        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SupplierRequest $request, string $id)
    {
        $supplier = $this->supplierService->update(
            $id,
            $request->validated()
        );

        $this->activityLogService->log(
            'Supplier',
            'Mengubah supplier "' . $supplier->name . '"'
        );

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = $this->supplierService->getById($id);

        $this->activityLogService->log(
            'Supplier',
            'Menghapus supplier "' . $supplier->name . '"'
        );

        $this->supplierService->delete($id);

        return redirect()
            ->route('suppliers.index')
            ->with('success', 'Supplier berhasil dihapus.');
    }
}