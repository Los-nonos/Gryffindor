<?php

namespace Presentation\Providers;

use Illuminate\Support\ServiceProvider;

use Application\Validators\Users\UpdateUserValidator;
use Application\Validators\Users\UpdateUserValidatorInterface;

use Application\Results\Users\UpdateUserResult;
use Application\Results\Users\UpdateUserResultInterface;

use Presentation\Http\Presenters\Users\UpdateUserPresenter;
use Presentation\Interfaces\UpdateUserPresenterInterface;

use Domain\Interfaces\UserRepositoryInterface;
use Infrastructure\Persistence\Doctrine\Repositories\UserRepository;

use Presentation\Interfaces\ValidatorServiceInterface;
use Presentation\Services\ValidatorService;

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

        $this->app->bind(
            UpdateUserValidatorInterface::class,
            UpdateUserValidator::class
        );

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
