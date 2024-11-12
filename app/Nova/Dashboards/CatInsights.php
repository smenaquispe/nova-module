<?php

namespace App\Nova\Dashboards;
use App\Nova\Metrics\TotalCats;
use App\Nova\Metrics\AverageCatsWeight;
use App\Nova\Metrics\AverageCatsSize;
use App\Nova\Metrics\CatsPerDay;
use Laravel\Nova\Dashboard;

class CatInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            TotalCats::make(),
            AverageCatsWeight::make(),
            AverageCatsSize::make(),
            CatsPerDay::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'cat-insights';
    }

    /**
     * Get the displayable name of the dashboard.
     * 
     * @return string
     **/
    public function name()
    {
        return 'Cat Insights';
    }
}
