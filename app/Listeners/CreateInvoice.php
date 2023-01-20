<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use App\Traits\Invoiceable;

class CreateInvoice
{

    use Invoiceable;

    /**
     * Handle the event.
     *
     * @param  \App\Events\PaymentEvent  $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        if (config('SETTINGS::INVOICE:ENABLED') == 'true') {
            // get user from payment which does hold the user_id
            $user = $event->payment->user;

            // create invoice using the trait
            $this->createInvoice($user, $event->payment);
        }
    }
}