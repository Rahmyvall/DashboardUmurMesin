<?php

namespace App\Providers;

use App\Events\AlertCreated;
use App\Events\AlertRead;
use App\Events\AlertResolved;
use App\Listeners\SendAlertNotification;
use App\Listeners\LogAlertActivity;
use App\Listeners\NotifyMachineOwner;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        // Laravel Default
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],

        // ==================== ALERT EVENTS ====================

        // Saat alert baru dibuat
        AlertCreated::class => [
            SendAlertNotification::class,      // Kirim notifikasi (database + broadcast)
            NotifyMachineOwner::class,         // Notifikasi khusus ke pemilik mesin
            LogAlertActivity::class,           // Catat ke log
        ],

        // Saat alert ditandai sudah dibaca
        AlertRead::class => [
            LogAlertActivity::class,
            // Bisa tambah event lain jika diperlukan
        ],

        // Saat alert diselesaikan (resolved)
        AlertResolved::class => [
            LogAlertActivity::class,
            // NotifyResolver::class,          // Beritahu siapa yang menyelesaikan (opsional)
        ],
    ];

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false; // Kita gunakan mapping manual agar lebih terkontrol
    }

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        // Bisa tambahkan logic boot jika diperlukan
    }
}