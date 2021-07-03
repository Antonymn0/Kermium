<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // user events
        'App\Events\UserCreated' => [
            //
        ],
        'App\Events\UserUpdated' => [
            //
        ],
        'App\Events\UserDestroyed' => [
            //
        ],

        // Order events
        'App\Events\OrderCreated' => [
            //
        ],
        'App\Events\OrderUpdated' => [
            //
        ],
        'App\Events\OrderDestroyed' => [
            //
        ],

        // Payment events
        'App\Events\PaymentCreated' => [
            //
        ],
        'App\Events\PaymentUpdated' => [
            //
        ],
        'App\Events\PaymentDestroyed' => [
            //
        ],

        // Refund events
        'App\Events\RefundCreated' => [
            //
        ],
        'App\Events\RefundUpdated' => [
            //
        ],
        'App\Events\RefundDestroyed' => [
            //
        ]
        
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
