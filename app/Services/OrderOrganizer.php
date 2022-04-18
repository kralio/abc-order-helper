<?php

namespace App\Services;

use App\Contracts\Services\OrderOrganizer as OrderOrganizerContract;

use Illuminate\Support\Carbon;

class OrderOrganizer implements OrderOrganizerContract
{
    public function getOrderStartDate(): Carbon
    {
        return new Carbon('2021-01-13');
    }

    public function getQuantityForOrderOnDate(Carbon $date): int
    {
        $startDate = $this->getOrderStartDate();
        if ($startDate->timestamp > $date->timestamp) {
            return 0;
        }

        $daySequenceNumber = $date->diffInDays($startDate);

        $prev = 0;
        $next = 1;

        for ($i = 0; $i < $daySequenceNumber; $i++) {
            $tmp = $next;
            $next += $prev;
            $prev = $tmp;
        }

        return $prev;
    }
}
