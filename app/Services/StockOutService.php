<?php

namespace App\Services;

use App\Interfaces\StockOutRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Services\ActivityLogService;

class StockOutService
{
    protected $stockOutRepository;
    protected $activityLogService;


    public function __construct(
    StockOutRepositoryInterface $stockOutRepository,
    ActivityLogService $activityLogService
) {
    $this->stockOutRepository = $stockOutRepository;
    $this->activityLogService = $activityLogService;
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



            $stockOut = $this->stockOutRepository->store($data);

$product = Product::findOrFail($stockOut->product_id);

$this->activityLogService->log(
    'Stock Out',
    'Membuat permintaan Stock Out produk "' .
    $product->name .
    '" sebanyak ' .
    $stockOut->qty .
    ' pcs'
);

return $stockOut;

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



            $updated = $this->stockOutRepository->getById($id);

$product = Product::findOrFail($updated->product_id);

$this->activityLogService->log(
    'Stock Out',
    'Mengubah permintaan Stock Out produk "' .
    $product->name .
    '" menjadi ' .
    $updated->qty .
    ' pcs'
);

return $updated;

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



            $this->activityLogService->log(
                'Approval Stock Out',
                'Menyetujui Stock Out produk "' .
                $product->name .
                '" sebanyak ' .
                $stockOut->qty .
                ' pcs'
            );

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

        $product = Product::findOrFail($stockOut->product_id);

        $this->activityLogService->log(
            'Approval Stock Out',
            'Menolak Stock Out produk "' .
            $product->name .
            '" sebanyak ' .
            $stockOut->qty .
            ' pcs'
        );

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

            $product = Product::findOrFail($stockOut->product_id);

            $this->activityLogService->log(
                'Stock Out',
                'Menghapus transaksi Stock Out produk "' .
                $product->name .
                '" sebanyak ' .
                $stockOut->qty .
                ' pcs'
            );



            $this->stockOutRepository
                ->delete($id);




            return true;

        });
    }


}