<?php

namespace App\Enums;

enum CommentStatus
{
    case Show;
    case Deleted;

    public function getStringValue(bool $toLowerCase = false): string
    {
        return match ($this) {
            self::Show => $toLowerCase ? 'show' : 'Show',
            self::Deleted => $toLowerCase ? 'deleted' : 'Deleted',
        };
    }
}
