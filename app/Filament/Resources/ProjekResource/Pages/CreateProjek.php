<?php

namespace App\Filament\Resources\ProjekResource\Pages;

use App\Filament\Resources\ProjekResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Filament\Notifications\Notification;

class CreateProjek extends CreateRecord
{
    protected static string $resource = ProjekResource::class;

    protected function getRedirectUrl(): string {
        return $this->previousUrl ?? $this->getResource()::getUrl('index');
    }
}
