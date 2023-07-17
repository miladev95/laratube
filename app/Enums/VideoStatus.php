<?php

namespace App\Enums;

enum VideoStatus
{
    case Pending;
    case Approved;
    case Rejected;
    case Deleted;

    public function getStringValue(): string
    {
        return match ($this) {
            self::Pending => 'Pending',
            self::Rejected => 'Rejected',
            self::Approved => 'Approved',
            self::Deleted => 'Deleted',
        };
    }
}
