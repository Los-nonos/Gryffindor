<?php

namespace Infrastructure\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'Application\Events\SendEmailWithData' => [
            'Application\Listeners\SendEmailNotification'
        ]
    ];

    protected $subscribe = [
        'Application\Listeners\SendEmailNotification',
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
