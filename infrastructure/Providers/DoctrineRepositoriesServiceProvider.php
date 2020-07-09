<?php
declare(strict_types=1);

namespace Infrastructure\Providers;


use Domain\Interfaces\Repositories\BrandRepositoryInterface;
use Domain\Interfaces\Repositories\CategoryRepositoryInterface;
use Domain\Interfaces\Repositories\CustomerRepositoryInterface;
use Domain\Interfaces\Repositories\EmployeeRepositoryInterface;
use Domain\Interfaces\Repositories\FilterRepositoryInterface;
use Domain\Interfaces\Repositories\NotificationRepositoryInterface;
use Domain\Interfaces\Repositories\OrderRepositoryInterface;
use Domain\Interfaces\Repositories\ProductRepositoryInterface;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Domain\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use Infrastructure\Persistence\Repositories\BrandRepository;
use Infrastructure\Persistence\Repositories\CategoryRepository;
use Infrastructure\Persistence\Repositories\CustomerRepository;
use Infrastructure\Persistence\Repositories\EmployeeRepository;
use Infrastructure\Persistence\Repositories\FilterRepository;
use Infrastructure\Persistence\Repositories\NotificationRepository;
use Infrastructure\Persistence\Repositories\OrderRepository;
use Infrastructure\Persistence\Repositories\ProductRepository;
use Infrastructure\Persistence\Repositories\TokenRepository;
use Infrastructure\Persistence\Repositories\UserRepository;

final class DoctrineRepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(CustomerRepositoryInterface::class, CustomerRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TokenRepositoryInterface::class, TokenRepository::class);
        $this->app->bind(EmployeeRepositoryInterface::class, EmployeeRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FilterRepositoryInterface::class, FilterRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(BrandRepositoryInterface::class, BrandRepository::class);
        $this->app->bind(NotificationRepositoryInterface::class, NotificationRepository::class);
    }
}
