<?php

namespace App\Services\PerformanceDashboard;

use App\Models\Company\Technology;
use App\Models\Lead\Lead;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TechnologyQuarterCountService
{
    public function getTechnologiesQuarterCounts($year)
    {
        $technologies = Technology::where('technology_status', 1)->get();
        $technologiesQuarterCounts = [];

        foreach ($technologies as $tech) {
            $counts = [];
            for ($q = 1; $q <= 4; $q++) {
                $start = Carbon::create($year, ($q - 1) * 3 + 1, 1)->startOfMonth();
                $end = (clone $start)->addMonths(2)->endOfMonth();

                $counts['q' . $q] = Lead::where('technology_id', $tech->technology_id)
                    ->whereNotNull('joining_date')
                    ->whereBetween(
                        DB::raw("STR_TO_DATE(joining_date, '%d-%m-%Y')"),
                        [$start->toDateString(), $end->toDateString()]
                    )
                    ->where('interview_status', 5)
                    ->count();
            }
            $technologiesQuarterCounts[$tech->technology_id] = $counts;
        }

        return [
            'technologies' => $technologies,
            'technologiesQuarterCounts' => $technologiesQuarterCounts
        ];
    }
}
