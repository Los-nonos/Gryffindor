<?php

namespace presentation\Providers;

use Application\Services\Token\TokenLoginService;
use Application\Services\Token\TokenLoginServiceInterface;
use Application\Services\Users\UserService;
use Application\Services\Users\UserServiceInterface;
use Domain\Interfaces\Repositories\TokenRepositoryInterface;
use Domain\Interfaces\Services\GetUserTypeServiceInterface;
use Domain\Services\Users\GetUserTypeService;
use Illuminate\Support\ServiceProvider;

use Application\Validators\Users\UpdateUserValidator;
use Application\Validators\Users\UpdateUserValidatorInterface;

use Application\Results\Users\UpdateUserResult;
use Application\Results\Users\UpdateUserResultInterface;

use Infrastructure\Persistence\Doctrine\Repositories\TokenRepository;
use presentation\Http\Presenters\Users\UpdateUserPresenter;
use presentation\Interfaces\UpdateUserPresenterInterface;

use Domain\Interfaces\UserRepositoryInterface;
use Infrastructure\Persistence\Doctrine\Repositories\UserRepository;

use presentation\Interfaces\ValidatorServiceInterface;
use presentation\Services\ValidatorService;

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

        $this->app->bind(
            UpdateUserResultInterface::class,
            UpdateUserResult::class
        );

        $this->app->bind(
            UpdateUserPresenterInterface::class,
            UpdateUserPresenter::class
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
