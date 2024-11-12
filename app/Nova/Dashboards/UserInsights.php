<?php

namespace App\Nova\Dashboards;

use Laravel\Nova\Dashboard;
use App\Nova\Metrics\TotalUsers;
use Illuminate\Http\Request;
use Laravel\Nova\Menu\MenuItem;

class UserInsights extends Dashboard
{
    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            TotalUsers::make(),
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'user-insights';
    }

    /**
     * Get the displayable name of the dashboard.
     * 
     * @return string
     **/
    public function name()
    {
        return 'User Insights';
    }

}
