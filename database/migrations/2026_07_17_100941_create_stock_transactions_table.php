<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_transactions', function (Blueprint $table) {

            $table->id();

            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum('type', [
                'IN',
                'OUT',
                'OPNAME'
            ]);

            $table->integer('quantity');

            $table->decimal('price', 15, 2)
                ->nullable();

            $table->date('transaction_date');

            $table->text('description')
                ->nullable();

            $table->timestamps();

        });
    }


    public function down(): void
    {
        Schema::dropIfExists('stock_transactions');
    }
};