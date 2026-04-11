<?php

namespace App\Listeners;

use App\Events\AlertCreated;
use Illuminate\Contracts\Queue\ShouldQueue;

class NotifyMachineOwner implements ShouldQueue
{
    public function handle(AlertCreated $event): void
    {
        $alert = $event->alert;

        // Logic khusus untuk owner mesin (bisa beda channel)
        // Misalnya: kirim via WhatsApp, Email, atau SMS
    }
}