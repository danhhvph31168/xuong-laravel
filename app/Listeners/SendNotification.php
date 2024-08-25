<?php

namespace App\Listeners;

use App\Events\OrderCreate;
use App\Notifications\InvoicePaid;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreate $event): void
    {
        $order = $event->order;
        $user = $order->user;
        $user->notify(new InvoicePaid($order));
    }
}
