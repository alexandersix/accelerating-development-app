<?php

namespace App\Filament\Clusters\Publications\Pages;

use App\Enums\UserRole;
use App\Filament\Clusters\Publications;
use App\Models\User;
use Filament\Pages\Page;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class MySubscribers extends Page implements HasTable
{
    use InteractsWithTable;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.clusters.publications.pages.my-subscribers';

    protected static ?string $cluster = Publications::class;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->whereHas('subscriptions', function (Builder $query) {
                        $query->where('author_id', auth()->id());
                    })
                    ->where('role', UserRole::Subscriber)
            )
            ->columns([
                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('email')
                    ->searchable(),
                TextColumn::make('email_verified_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ]);
    }
}
