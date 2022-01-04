<?php

namespace App\Providers;

use App\Events\CheckProduct;
use App\Events\NotifyNewOrder;
use App\Events\UpdateInventory;
use App\Listeners\CheckProductListener;
use App\Listeners\NotifyNewOrderListener;
use App\Listeners\UpdateInventoryListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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

        NotifyNewOrder::class => [
            NotifyNewOrderListener::class
        ],

        UpdateInventory::class => [
            UpdateInventoryListener::class
        ],

        CheckProduct::class => [
            CheckProductListener::class
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
