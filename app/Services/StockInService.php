<?php

namespace App\Services;

use App\Interfaces\StockInRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class StockInService
{
    protected $stockInRepository;


    public function __construct(
        StockInRepositoryInterface $stockInRepository
    ) {
        $this->stockInRepository = $stockInRepository;
    }



    public function getAll($search = null)
    {
        return $this->stockInRepository
                    ->getAll($search);
    }



    public function getById($id)
    {
        return $this->stockInRepository
                    ->getById($id);
    }




    /**
     * Manager membuat request Stock In
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {


            $data['status'] = 'pending';


            return $this->stockInRepository
                        ->store($data);

        });
    }





    /**
     * Update transaksi Stock In
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id, $data) {


            $stockIn = $this->stockInRepository
                            ->getById($id);



            // transaksi yang sudah approve tidak boleh diedit
            if($stockIn->status !== 'pending')
            {
                throw new \Exception(
                    'Stock In sudah diproses dan tidak dapat diubah.'
                );
            }



            $data['status'] = 'pending';



            $this->stockInRepository
                 ->update($id,$data);



            return $this->stockInRepository
                        ->getById($id);

        });
    }






    /**
     * Staff approve Stock In
     */
    public function approve($id)
    {
        return DB::transaction(function () use ($id) {


            $stockIn = $this->stockInRepository
                            ->getById($id);



            if($stockIn->status !== 'pending')
            {
                throw new \Exception(
                    'Transaksi sudah diproses.'
                );
            }



            $product = Product::findOrFail(
                $stockIn->product_id
            );



            // stok bertambah saat approve
            $product->increment(
                'stock',
                $stockIn->qty
            );



            $stockIn->update([

                'status' => 'approved',

                'approved_by' => auth()->id(),

                'approved_at' => now(),

            ]);



            return $stockIn;

        });
    }






    /**
     * Staff menolak Stock In
     */
    public function reject($id,$reason = null)
    {
        $stockIn = $this->stockInRepository
                        ->getById($id);



        $stockIn->update([

            'status' => 'rejected',

            'approved_by' => auth()->id(),

            'approved_at' => now(),

            'rejection_reason' => $reason,

        ]);



        return $stockIn;
    }






    /**
     * Hapus Stock In
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {


            $stockIn = $this->stockInRepository
                            ->getById($id);



            /*
            Jika sudah approve,
            kembalikan stok dahulu
            */

            if($stockIn->status === 'approved')
            {

                $product = Product::findOrFail(
                    $stockIn->product_id
                );


                $product->decrement(
                    'stock',
                    $stockIn->qty
                );

            }



            $this->stockInRepository
                 ->delete($id);



            return true;

        });
    }

}