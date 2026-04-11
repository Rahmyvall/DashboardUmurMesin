<?php

namespace App\Observers;

use App\Models\Alert;
use App\Events\AlertCreated;
use App\Events\AlertRead;
use App\Events\AlertResolved;

class AlertObserver
{
    /**
     * Handle the Alert "created" event.
     */
    public function created(Alert $alert): void
    {
        // Dispatch event agar bisa ditangani oleh listener (notifikasi, log, dll)
        AlertCreated::dispatch($alert);

        // Contoh: Auto mark as unread (sudah default)
        // Bisa tambah logic lain seperti cek apakah perlu dikirim ke email/user terkait
    }

    /**
     * Handle the Alert "updated" event.
     */
    public function updated(Alert $alert): void
    {
        // Deteksi perubahan spesifik
        if ($alert->isDirty('is_read') && $alert->is_read) {
            AlertRead::dispatch($alert);
        }

        if ($alert->isDirty('resolved') && $alert->resolved) {
            AlertResolved::dispatch($alert);
        }
    }

    /**
     * Handle the Alert "deleted" event.
     */
    public function deleted(Alert $alert): void
    {
        // Bisa cleanup related data jika diperlukan
    }

    /**
     * Handle the Alert "restored" event (jika pakai SoftDeletes).
     */
    // public function restored(Alert $alert): void
    // {
    //     //
    // }

    /**
     * Handle the Alert "force deleted" event.
     */
    // public function forceDeleted(Alert $alert): void
    // {
    //     //
    // }
}