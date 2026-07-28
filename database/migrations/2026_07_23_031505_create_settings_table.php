<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('settings', function (Blueprint $table) {

        $table->id();

        $table->string('app_name')
            ->default('Stockify');

        $table->string('company_name')
            ->nullable();

        $table->string('email')
            ->nullable();

        $table->string('phone')
            ->nullable();

        $table->text('address')
            ->nullable();

        $table->string('website')
            ->nullable();

        $table->text('description')
            ->nullable();

        $table->string('logo')
            ->nullable();

        $table->string('favicon')
            ->nullable();


        $table->integer('default_pagination')
            ->default(10);

        $table->integer('minimum_stock')
            ->default(5);


        $table->string('timezone')
            ->default('Asia/Jakarta');


        $table->string('currency')
            ->default('IDR');


        $table->string('footer')
            ->nullable();


        $table->timestamps();

    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
