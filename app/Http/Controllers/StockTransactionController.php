<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockTransactionRequest;
use App\Services\ProductService;
use App\Services\StockTransactionService;
use App\Http\Requests\StoreStockTransactionRequest;
use App\Http\Requests\UpdateStockTransactionRequest;


class StockTransactionController extends Controller
{
    protected $stockTransactionService;
    protected $productService;


    public function __construct(
        StockTransactionService $stockTransactionService,
        ProductService $productService
    ) {
        $this->stockTransactionService = $stockTransactionService;
        $this->productService = $productService;
    }


    /**
     * Display a listing of transactions.
     */
    public function index()
    {
        $transactions = $this->stockTransactionService->getAll();

        return view(
            'stock-transactions.index',
            compact('transactions')
        );
    }


    /**
     * Show form create.
     */
    public function create()
    {
       $products = $this->productService->getAllData();

        return view(
            'stock-transactions.create',
            compact('products')
        );
    }


    /**
     * Store transaction.
     */
    public function store(StoreStockTransactionRequest $request)
{
    try {

        $this->stockTransactionService->store($request->validated());

        return redirect()
            ->route('stock-transactions.index')
            ->with('success', 'Transaksi berhasil ditambahkan.');

    } catch (\Exception $e) {

        return back()
            ->withInput()
            ->with('error', $e->getMessage());
    }
}


    /**
     * Detail transaction.
     */
    public function show(string $id)
    {
        $transaction = $this->stockTransactionService
            ->getById($id);


        return view(
            'stock-transactions.show',
            compact('transaction')
        );
    }


    /**
     * Edit form.
     */
    public function edit(string $id)
    {
        $transaction = $this->stockTransactionService
            ->getById($id);


        $products = $this->productService->getAllData();


        return view(
            'stock-transactions.edit',
            compact(
                'transaction',
                'products'
            )
        );
    }


    /**
     * Update transaction.
     */
    public function update(
        StockTransactionRequest $request,
        string $id
    ) {

        $this->stockTransactionService->update(
            $id,
            $request->validated()
        );


        return redirect()
            ->route('stock-transactions.index')
            ->with(
                'success',
                'Transaksi stok berhasil diperbarui.'
            );
    }


    /**
     * Delete transaction.
     */
    public function destroy(string $id)
    {
        $this->stockTransactionService->delete($id);


        return redirect()
            ->route('stock-transactions.index')
            ->with(
                'success',
                'Transaksi stok berhasil dihapus.'
            );
    }
}