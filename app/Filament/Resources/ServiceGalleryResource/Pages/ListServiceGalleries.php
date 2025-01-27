<?php

namespace App\Filament\Resources\ServiceGalleryResource\Pages;

use App\Filament\Resources\ServiceGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListServiceGalleries extends ListRecords
{
    protected static string $resource = ServiceGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
