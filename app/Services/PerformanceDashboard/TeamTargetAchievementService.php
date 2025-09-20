<?php

namespace App\Services\PerformanceDashboard;

use App\Models\PerformanceDashboard\CreateTargetModel;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TeamTargetAchievementService
{
    /**
     * Get team-wise targets and achieved counts grouped by quarter.
     */
    public function getTeamWiseTargetsByQuarter(int $year)
    {
        $quarterMonthRanges = [
            1 => [1, 3],
            2 => [4, 6],
            3 => [7, 9],
            4 => [10, 12],
        ];

        $targets = CreateTargetModel::with('technology')
            ->where('year', $year)
            ->where('status', 'Enabled')
            ->orderBy('year', 'desc')
            ->orderBy('quarter')
            ->get()
            ->map(function ($target) use ($year, $quarterMonthRanges) {
                $months = $quarterMonthRanges[$target->quarter];

                $quarterStart = Carbon::create($year, $months[0], 1)->startOfDay();
                $quarterEnd = Carbon::create($year, $months[1], 1)->endOfMonth()->endOfDay();

                $query = DB::table('leads')
                    ->where('interview_status', '5')
                    ->where('technology_id', $target->technology_id)
                  
                    ->whereBetween(
                        DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"),
                        [$quarterStart->toDateString(), $quarterEnd->toDateString()]
                    );

                if ($target->shift === 'Night') {
                    $query->where('region', 'USA');
                } else {
                    $query->where(function ($q) {
                        $q->where('region', '!=', 'USA')->orWhereNull('region');
                    });
                }

                $target->achieved = $query->count();

                return $target;
            });

        return $targets->groupBy('quarter');
    }
}
