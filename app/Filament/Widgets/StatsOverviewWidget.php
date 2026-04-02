<?php
// app/Filament/Widgets/StatsOverviewWidget.php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class StatsOverviewWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $totalRevenue = Order::sum('total');
        $totalOrders = Order::count();
        $totalProducts = Product::count();
        $totalCustomers = User::whereHas('orders')->count();

        return [
            Stat::make('Total Revenue', '₹' . number_format($totalRevenue, 2))
                ->description('30% increase')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),
            
            Stat::make('Total Orders', $totalOrders)
                ->description('3% decrease')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->color('danger')
                ->chart([17, 16, 14, 15, 14, 13, 12]),
            
            Stat::make('Total Products', $totalProducts)
                ->description('12 new this month')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->color('success'),
            
            Stat::make('Total Customers', $totalCustomers)
                ->description('Active customers')
                ->descriptionIcon('heroicon-m-users'),
        ];
    }

    protected function getColumns(): int
    {
        return 4;
    }
}