<?php

namespace App\Http\Middleware;

class ScheduleAdminMiddleware extends ScheduleMiddleware
{
    public function __construct()
    {
        parent::__construct(
            startHour: 9,
            endHour: 18,
            permission: "user access"
        );
    }
}
