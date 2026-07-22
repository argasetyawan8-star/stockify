<?php

namespace App\Http\Controllers;

use App\Http\Requests\StockOutRequest;
use App\Models\Product;
use App\Services\ActivityLogService;
use App\Services\StockOutService;
use Exception;

class StockOutController extends Controller
{

    protected $stockOutService;
    protected $activityLogService;



    public function __construct(
        StockOutService $stockOutService,
        ActivityLogService $activityLogService
    ) {

        $this->stockOutService = $stockOutService;

        $this->activityLogService = $activityLogService;

    }





    public function index()
    {

        $stockOuts = $this->stockOutService
            ->getAll(request('search'));


        return view(
            'stock-outs.index',
            compact('stockOuts')
        );

    }





    public function create()
    {

        $products = Product::orderBy('name')
            ->get();


        return view(
            'stock-outs.create',
            compact('products')
        );

    }





    public function store(StockOutRequest $request)
    {

        try {


            $stockOut = $this->stockOutService
                ->store(
                    $request->validated()
                );


            $stockOut->load('product');



            $this->activityLogService->store([

                'user_id' => auth()->id(),

                'module' => 'Stock Out',

                'activity' =>
                    'Menambahkan Stock Out produk "'
                    .$stockOut->product->name
                    .'" sebanyak '
                    .$stockOut->qty,

                'ip_address' => request()->ip(),

            ]);



            return redirect()
                ->route('stock-outs.index')
                ->with(
                    'success',
                    'Stock Out berhasil ditambahkan.'
                );


        } catch(Exception $e) {


            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }





    public function show(string $id)
    {

        $stockOut = $this->stockOutService
            ->getById($id);


        return view(
            'stock-outs.show',
            compact('stockOut')
        );

    }





    public function edit(string $id)
    {

        $stockOut = $this->stockOutService
            ->getById($id);


        $products = Product::orderBy('name')
            ->get();



        return view(
            'stock-outs.edit',
            compact(
                'stockOut',
                'products'
            )
        );

    }





    public function update(
        StockOutRequest $request,
        string $id
    )
    {

        try {


            $stockOut = $this->stockOutService
                ->update(
                    $id,
                    $request->validated()
                );


            $stockOut->load('product');



            $this->activityLogService->store([

                'user_id' => auth()->id(),

                'module' => 'Stock Out',

                'activity' =>
                    'Mengubah Stock Out produk "'
                    .$stockOut->product->name
                    .'"',

                'ip_address' => request()->ip(),

            ]);



            return redirect()
                ->route('stock-outs.index')
                ->with(
                    'success',
                    'Stock Out berhasil diperbarui.'
                );


        } catch(Exception $e) {


            return back()
                ->withInput()
                ->with(
                    'error',
                    $e->getMessage()
                );

        }

    }





    public function destroy(string $id)
    {

        $stockOut = $this->stockOutService
            ->getById($id);



        $stockOut->load('product');



        $this->activityLogService->store([

            'user_id' => auth()->id(),

            'module' => 'Stock Out',

            'activity' =>
                'Menghapus Stock Out produk "'
                .$stockOut->product->name
                .'"',

            'ip_address' => request()->ip(),

        ]);



        $this->stockOutService
            ->delete($id);



        return redirect()
            ->route('stock-outs.index')
            ->with(
                'success',
                'Stock Out berhasil dihapus.'
            );

    }

}