<?php

namespace App\Filament\Widgets;

use App\Models\Pelatihan;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\UserPelatihan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverviewWidget extends BaseWidget
{

    protected function getStats(): array
    {
        return [
            Stat::make('Users', User::count()),
            Stat::make('Total Pelatihan', Pelatihan::count()),
            Stat::make('Yang mengikuti pelatihan', UserPelatihan::count()),
            Stat::make('History payment', Transaksi::count()),
        ];
    }
}