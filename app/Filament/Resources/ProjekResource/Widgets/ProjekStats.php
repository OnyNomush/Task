<?php

namespace App\Filament\Resources\ProjekResource\Widgets;

use App\Models\Projek;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class ProjekStats extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Belum Dikerjakan', Projek::where('status', 'Belum Dikerjakan')->count())
                ->description('Proyek yang belum dimulai')
                ->descriptionIcon('heroicon-o-clock')
                ->color('danger'),  

            Card::make('Dalam Proses', Projek::where('status', 'Dalam Proses')->count())
                ->description('Proyek sedang dikerjakan')
                ->descriptionIcon('heroicon-o-paper-airplane')
                ->color('warning'),

            Card::make('Siap Launch', Projek::where('status', 'Siap Launch')->count())
                ->description('Proyek siap diluncurkan')
                ->descriptionIcon('heroicon-o-rocket-launch')
                ->color('success'),
        ];
    }
}
