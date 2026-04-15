<?php
// app/Filament/Pages/Dashboard.php

namespace App\Filament\Pages;

use BackedEnum;
use Filament\Pages\Dashboard as BaseDashboard;
use Filament\Support\Icons\Heroicon;

class Dashboard extends BaseDashboard
{
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedHome;
    
    protected static ?string $navigationLabel = 'Dashboard';
    
    protected static ?int $navigationSort = 0;
    
    public $activeTab = 'overview';
    
    public function getTabs(): array
    {
        return [
            'overview' => [
                'label' => 'Overview',
                'icon' => 'heroicon-o-chart-bar',
                'widgets' => [
                    \App\Filament\Widgets\StatsOverviewWidget::class,
                    \App\Filament\Widgets\SalesChartWidget::class,
                    \App\Filament\Widgets\CustomerInsightsWidget::class,
                ],
            ],
            'orders' => [
                'label' => 'Recent Orders',
                'icon' => 'heroicon-o-shopping-cart',
                'widgets' => [
                    \App\Filament\Widgets\RecentOrdersWidget::class,
                ],
            ],
            'products' => [
                'label' => 'Top Products',
                'icon' => 'heroicon-o-cube',
                'widgets' => [
                    \App\Filament\Widgets\TopProductsWidget::class,
                ],
            ],
        ];
    }
    
    public function getWidgets(): array
    {
        $tab = $this->getTabs()[$this->activeTab] ?? $this->getTabs()['overview'];
        return $tab['widgets'];
    }
}