<?php

namespace App\Filament\Subscriber\Resources\PublicationResource\Pages;

use App\Filament\Subscriber\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublication extends EditRecord
{
    protected static string $resource = PublicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
