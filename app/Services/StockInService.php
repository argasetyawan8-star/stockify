<?php

namespace App\Services;

use App\Interfaces\StockInRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use App\Services\ActivityLogService;

class StockInService
{
    protected $stockInRepository;
    protected $activityLogService;


   public function __construct(
    StockInRepositoryInterface $stockInRepository,
    ActivityLogService $activityLogService
) {
    $this->stockInRepository = $stockInRepository;
    $this->activityLogService = $activityLogService;
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


           $stockIn = $this->stockInRepository->store($data);

            $product = Product::findOrFail($stockIn->product_id);

            $this->activityLogService->log(
                'Stock In',
                'Membuat permintaan Stock In produk "' .
                $product->name .
                '" sebanyak ' .
                $stockIn->qty .
                ' pcs'
);

return $stockIn;

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



           $updated = $this->stockInRepository->getById($id);

                $product = Product::findOrFail($updated->product_id);

                $this->activityLogService->log(
                    'Stock In',
                    'Mengubah permintaan Stock In produk "' .
                    $product->name .
                    '" menjadi ' .
                    $updated->qty .
                    ' pcs'
                );

                return $updated;


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

             $this->activityLogService->log(
                'Approval Stock In',
                'Menyetujui Stock In produk "' .
                $product->name .
                '" sebanyak ' .
                $stockIn->qty .
                ' pcs'
            );

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

            $product = Product::findOrFail($stockIn->product_id);

            $this->activityLogService->log(
                'Approval Stock In',
                'Menolak Stock In produk "' .
                $product->name .
                '" sebanyak ' .
                $stockIn->qty .
                ' pcs'
            );


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

            $product = Product::findOrFail($stockIn->product_id);

            $this->activityLogService->log(
                'Stock In',
                'Menghapus transaksi Stock In produk "' .
                $product->name .
                '" sebanyak ' .
                $stockIn->qty .
                ' pcs'
            );

            $this->stockInRepository
                 ->delete($id);



            return true;

        });
    }

}