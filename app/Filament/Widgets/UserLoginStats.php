<?php

namespace App\Filament\Widgets;

use App\Models\User;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class UserLoginStats extends BaseWidget
{
    protected function getCards(): array
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $endOfWeek = Carbon::now()->endOfWeek();

        $thisWeek = User::whereBetween('last_login_at', [$startOfWeek, $endOfWeek])->count();

        $beforeThisWeek = User::where('last_login_at', '<', $startOfWeek)->count();

        return [
            Card::make('Login Minggu Ini', $thisWeek)
                ->description('Pengguna yang login dari Senin hingga Minggu ini')
                ->color('success'),

            Card::make('Login Sebelumnya', $beforeThisWeek)
                ->description('Pengguna yang login sebelum minggu ini')
                ->color('danger'),
        ];
    }
}
