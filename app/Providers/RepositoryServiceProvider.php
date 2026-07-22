<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Interfaces
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\SupplierRepositoryInterface;

// Repositories
use App\Repositories\CategoryRepository;
use App\Repositories\SupplierRepository;
use App\Interfaces\ProductRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Interfaces\StockTransactionRepositoryInterface;
use App\Repositories\StockTransactionRepository;
use App\Interfaces\ReportRepositoryInterface;
use App\Repositories\ReportRepository;
use App\Interfaces\StockInRepositoryInterface;
use App\Repositories\StockInRepository;
use App\Interfaces\StockOutRepositoryInterface;
use App\Repositories\StockOutRepository;
use App\Interfaces\ProductAttributeRepositoryInterface;
use App\Repositories\ProductAttributeRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;
use App\Interfaces\ActivityLogRepositoryInterface;
use App\Repositories\ActivityLogRepository;
use App\Interfaces\ApprovalRepositoryInterface;
use App\Repositories\ApprovalRepository;
use Illuminate\Support\Facades\View;
use App\View\Composers\SidebarComposer;


class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // Category
        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        // Supplier
        $this->app->bind(
            SupplierRepositoryInterface::class,
            SupplierRepository::class
        );

                $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            StockTransactionRepositoryInterface::class,
            StockTransactionRepository::class
        );

        $this->app->bind(
            ReportRepositoryInterface::class,
            ReportRepository::class
        );

                $this->app->bind(
            StockInRepositoryInterface::class,
            StockInRepository::class
        );

        $this->app->bind(
            StockOutRepositoryInterface::class,
            StockOutRepository::class
        );

                $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );
       
            $this->app->bind(
            \App\Interfaces\StockOpnameRepositoryInterface::class,
            \App\Repositories\StockOpnameRepository::class
        );

                $this->app->bind(
            ActivityLogRepositoryInterface::class,
            ActivityLogRepository::class
        );

                $this->app->bind(
        ApprovalRepositoryInterface::class,
        ApprovalRepository::class
        );

              
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
{
    View::composer(
        'layouts.sidebar',
        SidebarComposer::class
    );
}
}