<?php

namespace App\Filament\Resources\MapEmbedResource\Pages;

use App\Filament\Resources\MapEmbedResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMapEmbeds extends ListRecords
{
    protected static string $resource = MapEmbedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
