<?php

namespace Infrastructure\Providers;

use Application\Services\Token\TokenLoginService;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserService;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Domain\Services\Users\GetUserTypeService;
use Illuminate\Support\ServiceProvider;

use Presentation\Http\Validations\Utils\ValidatorService;
use Presentation\Http\Validations\Utils\ValidatorServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(TokenLoginServiceInterface::class, TokenLoginService::class);

        $this->app->bind(GetUserTypeServiceInterface::class, GetUserTypeService::class);

        $this->app->bind(ValidatorServiceInterface::class, ValidatorService::class);
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
