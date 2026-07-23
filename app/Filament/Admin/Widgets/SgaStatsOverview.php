<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Person;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class SgaStatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [

            Stat::make(
                'Pessoas cadastradas',
                Person::count()
            )
            ->description('Total de pessoas no sistema')
            ->descriptionIcon('heroicon-m-users')
            ->color('success'),


            Stat::make(
                'Imóveis cadastrados',
                '0'
            )
            ->description('Módulo ainda será criado')
            ->descriptionIcon('heroicon-m-building-office')
            ->color('warning'),


            Stat::make(
                'Contratos ativos',
                '0'
            )
            ->description('Controle de contratos')
            ->descriptionIcon('heroicon-m-document-text')
            ->color('info'),


            Stat::make(
                'Receita mensal',
                'R$ 0,00'
            )
            ->description('Financeiro')
            ->descriptionIcon('heroicon-m-banknotes')
            ->color('primary'),

        ];
    }
}
