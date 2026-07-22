<?php

namespace App\Services;

use App\Interfaces\StockOutRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;

class StockOutService
{
    protected $stockOutRepository;


    public function __construct(
        StockOutRepositoryInterface $stockOutRepository
    ) {
        $this->stockOutRepository = $stockOutRepository;
    }





    public function getAll($search = null)
    {
        return $this->stockOutRepository
            ->getAll($search);
    }





    public function getById($id)
    {
        return $this->stockOutRepository
            ->getById($id);
    }






    /**
     * Manager membuat request Stock Out
     */
    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {


            // status awal pending

            $data['status'] = 'pending';



            return $this->stockOutRepository
                ->store($data);

        });
    }







    /**
     * Update transaksi pending
     */
    public function update($id, array $data)
    {
        return DB::transaction(function () use ($id,$data) {


            $stockOut = $this->stockOutRepository
                ->getById($id);



            if($stockOut->status !== 'pending')
            {
                throw new Exception(
                    'Stock Out sudah diproses dan tidak dapat diubah.'
                );
            }



            $data['status'] = 'pending';



            $this->stockOutRepository
                ->update($id,$data);



            return $this->stockOutRepository
                ->getById($id);

        });
    }







    /**
     * Staff approve Stock Out
     */
    public function approve($id)
    {
        return DB::transaction(function () use ($id) {


            $stockOut = $this->stockOutRepository
                ->getById($id);



            if($stockOut->status !== 'pending')
            {
                throw new Exception(
                    'Transaksi sudah diproses.'
                );
            }





            $product = Product::findOrFail(
                $stockOut->product_id
            );





            // cek stok saat approve

            if($product->stock < $stockOut->qty)
            {
                throw new Exception(
                    'Stok produk tidak mencukupi.'
                );
            }






            // kurangi stok

            $product->decrement(
                'stock',
                $stockOut->qty
            );






            $stockOut->update([

                'status' => 'approved',

                'approved_by' => auth()->id(),

                'approved_at' => now(),

            ]);





            return $stockOut;

        });
    }








    /**
     * Staff reject Stock Out
     */
    public function reject($id,$reason = null)
    {

        $stockOut = $this->stockOutRepository
            ->getById($id);



        if($stockOut->status !== 'pending')
        {
            throw new Exception(
                'Transaksi sudah diproses.'
            );
        }




        $stockOut->update([

            'status' => 'rejected',

            'approved_by' => auth()->id(),

            'approved_at' => now(),

            'rejection_reason' => $reason,

        ]);



        return $stockOut;

    }









    /**
     * Hapus Stock Out
     */
    public function delete($id)
    {
        return DB::transaction(function () use ($id) {


            $stockOut = $this->stockOutRepository
                ->getById($id);





            /*
             Jika sudah approve,
             stok harus dikembalikan
            */

            if($stockOut->status === 'approved')
            {

                $product = Product::findOrFail(
                    $stockOut->product_id
                );



                $product->increment(
                    'stock',
                    $stockOut->qty
                );

            }





            $this->stockOutRepository
                ->delete($id);




            return true;

        });
    }


}