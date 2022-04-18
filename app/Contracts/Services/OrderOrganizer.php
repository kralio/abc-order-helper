<?php

namespace App\Contracts\Services;

use Illuminate\Support\Carbon;

interface OrderOrganizer
{
    public function getOrderStartDate(): Carbon;

    /**
     * @throws \Exception
     */
    public function getQuantityForOrderOnDate(Carbon $date): int;
}
