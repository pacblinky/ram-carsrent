<?php

namespace App\Filament\Resources\MapEmbedResource\Pages;

use App\Filament\Resources\MapEmbedResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMapEmbed extends EditRecord
{
    protected static string $resource = MapEmbedResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
