<?php

namespace App\Filament\Subscriber\Resources\ArticleResource\Pages;

use App\Filament\Subscriber\Resources\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
