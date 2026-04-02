<?php
// app/Filament/Widgets/CustomerInsightsWidget.php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;
use App\Models\User;
use Carbon\Carbon;

class CustomerInsightsWidget extends ChartWidget
{
    // NOT static - remove 'static' keyword
    protected ?string $heading = 'Customer Growth';
    
    protected static ?int $sort = 2;
    
    protected int | string | array $columnSpan = 1;

    protected function getData(): array
    {
        $data = $this->getCustomerGrowth();
        
        return [
            'datasets' => [
                [
                    'label' => 'New Customers',
                    'data' => $data['customers'],
                    'backgroundColor' => '#10b981',
                    'borderRadius' => 4,
                ],
            ],
            'labels' => $data['months'],
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    private function getCustomerGrowth(): array
    {
        $months = [];
        $customers = [];

        for ($i = 4; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M');
            
            $newCustomers = User::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
            
            $customers[] = $newCustomers;
        }

        return [
            'months' => $months,
            'customers' => $customers,
        ];
    }
}