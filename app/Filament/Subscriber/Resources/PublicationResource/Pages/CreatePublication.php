<?php

namespace App\Filament\Subscriber\Resources\PublicationResource\Pages;

use App\Filament\Subscriber\Resources\PublicationResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePublication extends CreateRecord
{
    protected static string $resource = PublicationResource::class;
}
