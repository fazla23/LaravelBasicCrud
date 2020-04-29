<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegisterCustomerToNewsletter
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
    public function handle($event)
    {
        dump('Resgistered to newsletter');
    }
}
