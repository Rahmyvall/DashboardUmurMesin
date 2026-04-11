<?php

namespace App\Listeners;

use App\Events\AlertCreated;
use App\Notifications\NewAlertNotification;

class SendAlertNotification
{
    public function handle(AlertCreated $event): void
    {
        $alert = $event->alert;

        if ($alert->machine && $alert->machine->user) {
            $alert->machine->user->notify(new NewAlertNotification($alert));
        }
    }
}
