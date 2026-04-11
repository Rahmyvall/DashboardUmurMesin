<?php

namespace App\Enums;

enum AlertType: string
{
    case MAINTENANCE_DUE = 'maintenance_due';
    case OVERUSE         = 'overuse';
    case DAMAGE          = 'damage';
    case ERROR           = 'error';
    case WARNING         = 'warning';
}