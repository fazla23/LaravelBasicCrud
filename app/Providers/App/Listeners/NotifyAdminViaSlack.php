<?php

namespace App\Providers\App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyAdminViaSlack
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewCustomerHasRegisteredEvent  $event
     * @return void
     */
    public function handle(NewCustomerHasRegisteredEvent $event)
    {
        //
    }
}
