<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum UserRole: string implements HasColor, HasLabel
{
    case Admin = 'admin';

    case Subscriber = 'subscriber';

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::Admin => 'info',
            self::Subscriber => 'success',
        };
    }

    public function getLabel(): ?string
    {
        return match ($this) {
            self::Admin => 'Admin',
            self::Subscriber => 'Subscriber',
        };
    }
}
