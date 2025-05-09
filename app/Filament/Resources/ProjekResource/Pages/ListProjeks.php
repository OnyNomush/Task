<?php

namespace App\Filament\Resources\ProjekResource\Pages;

use App\Filament\Resources\ProjekResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ProjekResource\Widgets\ProjekStats;

class ListProjeks extends ListRecords
{
    protected static string $resource = ProjekResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProjekStats::class,
        ];
    }

}
