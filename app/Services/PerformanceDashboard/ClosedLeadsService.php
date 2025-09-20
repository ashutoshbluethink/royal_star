<?php

namespace App\Services\PerformanceDashboard;

use App\Models\Lead\Lead;
use Carbon\Carbon;

class ClosedLeadsService
{
    public function getClosedLeadsQuarterCounts($year)
    {
        $closedLeadsQuarterCounts = [];

        for ($q = 1; $q <= 4; $q++) {
            $start = Carbon::create($year, ($q - 1) * 3 + 1, 1)->startOfMonth();
            $end = (clone $start)->addMonths(2)->endOfMonth();

            $closedLeadsQuarterCounts['q' . $q] = Lead::where('is_project_closed', 1)
                ->whereNotNull('close_date')
                ->whereBetween('close_date', [$start->toDateString(), $end->toDateString()])
                ->count();
        }

        return $closedLeadsQuarterCounts;
    }
}
