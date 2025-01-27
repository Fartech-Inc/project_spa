<?php

namespace App\Filament\Resources\ServiceGalleryResource\Pages;

use App\Filament\Resources\ServiceGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateServiceGallery extends CreateRecord
{
    protected static string $resource = ServiceGalleryResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
