<?php

namespace Presentation\Providers;

use Illuminate\Support\ServiceProvider;

use Application\Validators\User\UpdateUserValidator;
use Application\Validators\User\UpdateUserValidatorInterface;

use Application\Results\User\UpdateUserResult;
use Application\Results\User\UpdateUserResultInterface;

use Presentation\Http\Presenters\User\UpdateUserPresenter;
use Presentation\Interfaces\UpdateUserPresenterInterface;

use Domain\Interfaces\UserRepositoryInterface;
use Infrastructure\Persistence\Doctrine\Repositories\UserRepository;


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
            EditUserResultInterface::class,
            EditUserResult::class
        );

        $this->app->bind(
            EditUserPresenterInterface::class,
            EditUserPresenter::class
        );

        $this->app->bind(
            EditUserValidatorInterface::class,
            EditUserValidator::class
        );
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
