<?php

namespace App\Listeners;

use App\Events\AlertCreated;
use App\Events\AlertRead;
use App\Events\AlertResolved;
use App\Models\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class LogAlertActivity
{
    public function handle(object $event): void
    {
        if (!isset($event->alert) || !$event->alert instanceof Alert) {
            return;
        }

        $alert = $event->alert;

        $logData = [
            'alert_id'   => $alert->id,
            'machine_id' => $alert->machine_id,
        ];

        if ($event instanceof AlertCreated) {
            $logData += [
                'type'     => $alert->alert_type,
                'severity' => $alert->severity,
                'title'    => $alert->title,
                'message'  => Str::limit($alert->message, 120),
            ];
            Log::info('New Alert Created', $logData);
        }
        elseif ($event instanceof AlertRead) {
            $logData['read_by'] = Auth::id() ?? 'system';
            Log::info('Alert Marked as Read', $logData);
        }
        elseif ($event instanceof AlertResolved) {
            $logData += [
                'resolved_by' => $alert->resolved_by ?? Auth::id() ?? 'system',
                'resolved_at' => $alert->resolved_at?->toDateTimeString(),
            ];
            Log::info('Alert Resolved', $logData);
        }
    }
}
