<?php

namespace App\Enums;

enum VideoStatus
{
    case Pending;
    case Approved;
    case Rejected;
    case Deleted;

    public function getStringValue(bool $toLowerCase = false): string
    {
        return match ($this) {
            self::Pending => $toLowerCase ? 'pending' : 'Pending',
            self::Rejected => $toLowerCase ? 'rejected' : 'Rejected',
            self::Approved => $toLowerCase ? 'approved' : 'Approved',
            self::Deleted => $toLowerCase ? 'deleted' : 'Deleted',
        };
    }

}
