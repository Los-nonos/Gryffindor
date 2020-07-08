<?php

namespace Infrastructure\Providers;

use Application\Services\Category\CategoryService;
use Application\Services\Category\CategoryServiceInterface;
use Application\Services\Customers\CustomerService;
use Application\Services\Customers\CustomerServiceInterface;
use Application\Services\Filters\FilterService;
use Application\Services\Filters\FilterServiceInterface;
use Application\Services\Hash\HashService;
use Application\Services\Hash\HashServiceInterface;

use Application\Services\Notification\NotifiableService;
use Application\Services\Notification\NotifiableServiceInterface;
use Application\Services\Orders\OrderService;
use Application\Services\Products\ProductService;
use Application\Services\Token\TokenLoginService;
use Application\Services\Token\TokenLoginServiceInterface;

use Application\Services\Users\UserService;
use Application\Services\Users\UserServiceInterface;

use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Domain\Interfaces\Services\Notifications\NotifiableInterface;
use Domain\Interfaces\Services\Orders\OrderServiceInterface;
use Domain\Interfaces\Services\Products\ProductServiceInterface;
use Domain\Services\Users\GetUserTypeService;

use Domain\ValueObjects\Notification;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

use Infrastructure\Cache\Provider\Redis\RedisProvider;

use Presentation\Http\Validations\Utils\ValidatorService;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

use Psr\Cache\CacheItemPoolInterface;
use Redis;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(HashServiceInterface::class, HashService::class);

        $this->app->singleton(Redis::class, function (Application $application) {
            $client = new Redis();

            $config = $application->make('config')->get('database.redis.cache');

            if (! $client->connect($config['host'], (int) $config['port'])) {
                throw new \Exception("Could not connect to Redis at {$config['host']}:{$config['port']}");
            }

            return $client;
        });
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(CustomerServiceInterface::class, CustomerService::class);

        $this->app->bind(CacheItemPoolInterface::class, RedisProvider::class);

        $this->app->bind(TokenLoginServiceInterface::class, TokenLoginService::class);

        $this->app->bind(GetUserTypeServiceInterface::class, GetUserTypeService::class);

        $this->app->bind(NotifiableServiceInterface::class, NotifiableService::class);

        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);

        $this->app->bind(FilterServiceInterface::class, FilterService::class);

        $this->app->bind(NotifiableInterface::class, Notification::class);

        $this->app->bind(ValidatorServiceInterface::class, ValidatorService::class);

        $this->app->bind(OrderServiceInterface::class,OrderService::class);

        $this->app->bind(ProductServiceInterface::class, ProductService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
