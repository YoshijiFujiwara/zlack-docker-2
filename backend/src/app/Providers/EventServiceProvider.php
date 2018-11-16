<?php

namespace App\Providers;

use App\Events\CreateMessageEvent;
use Illuminate\Support\Facades\Event;
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
        'App\Events\CreateMessageEvent' => ['App\Listeners\CreateMessageEventListner'],
        'App\Events\UpdateMessageEvent' => ['App\Listeners\UpdateMessageEventListner'],
        'App\Events\DeleteMessageEvent' => ['App\Listeners\DeleteMessageEventListner'],

        'App\Events\StarMessageEvent' => ['App\Listeners\StarMessageEvent'],
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
