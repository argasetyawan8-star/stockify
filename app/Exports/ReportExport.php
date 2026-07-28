<?php

namespace App\Exports;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use App\Models\StockOpname;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ReportExport implements FromCollection, WithHeadings
{

    protected $type;


    public function __construct($type)
    {
        $this->type = $type;
    }



    public function collection()
    {

        if($this->type == 'stock_in') {


            return StockIn::with('product')
            ->latest()
            ->get()
            ->map(function($item){

                return [

                    'tanggal' => $item->date,

                    'produk' =>
                    $item->product->name ?? '-',

                    'jenis' =>
                    'Stock In',

                    'qty' =>
                    $item->qty,

                    'status' =>
                    $item->status ?? '-',

                ];

            });



        }



        if($this->type == 'stock_out') {


            return StockOut::with('product')
            ->latest()
            ->get()
            ->map(function($item){

                return [

                    'tanggal'=>$item->date,

                    'produk'=>
                    $item->product->name ?? '-',

                    'jenis'=>
                    'Stock Out',

                    'qty'=>
                    $item->qty,

                    'status'=>
                    $item->status ?? '-',

                ];

            });


        }



        if($this->type == 'stock_opname') {


            return StockOpname::with('product')
            ->latest()
            ->get()
            ->map(function($item){

                return [

                    'tanggal'=>
                    $item->created_at,

                    'produk'=>
                    $item->product->name ?? '-',

                    'jenis'=>
                    'Stock Opname',

                    'qty'=>
                    $item->difference,

                    'status'=>
                    '-',

                ];

            });


        }



        // default inventory

        return Product::latest()
        ->get()
        ->map(function($item){


            return [

                'tanggal'=>now(),

                'produk'=>$item->name,

                'jenis'=>'Inventory',

                'qty'=>$item->stock,

                'status'=>'-',

            ];


        });


    }



    public function headings(): array
    {

        return [

            'Tanggal',

            'Produk',

            'Jenis',

            'Qty',

            'Status'

        ];

    }

}