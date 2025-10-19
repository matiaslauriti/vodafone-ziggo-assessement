<?php

namespace App\Domain\Enums;

enum ScanStatus: string
{
    case PENDING = 'pending';
    case IN_PROGRESS = 'in-progress';
    case COMPLETED = 'completed';
    case FAILED = 'failed';
}
