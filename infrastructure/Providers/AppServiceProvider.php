<?php

namespace Infrastructure\Providers;

use Application\Services\Token\TokenLoginService;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserService;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Domain\Services\Users\GetUserTypeService;
use Illuminate\Support\ServiceProvider;

use Infrastructure\Persistence\Doctrine\Repositories\TokenRepository;
use presentation\Http\Presenters\Users\UpdateUserPresenter;

use Domain\Interfaces\UserRepositoryInterface;
use Infrastructure\Persistence\Doctrine\Repositories\UserRepository;

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
        /**
         * User
         */
        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );


        $this->app->bind(UserServiceInterface::class, UserService::class);

        $this->app->bind(TokenRepositoryInterface::class, TokenRepository::class);

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
