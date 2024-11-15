<?php

namespace App\Http\Middleware;

class ScheduleAdminMiddleware extends ScheduleMiddleware
{
    public function __construct()
    {
        parent::__construct(
            startHour: 0,
            endHour: 24,
            permission: "admin access"
        );
    }
}
