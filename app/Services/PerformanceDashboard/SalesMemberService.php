<?php

namespace App\Services\PerformanceDashboard;

use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalesMemberService
{
    public function getSalesMembersWithQuarterCounts(int $year)
    {
        return User::where('role', 4)
            ->where('user_status', 1)
            ->get()
            ->filter(function ($member) use ($year) {
                $leads = DB::table('leads')
                    ->where('lead_created_user_id', $member->user_id)
                    ->get();

                if ($leads->isEmpty()) return false;

                $member->quarterCounts = $this->getQuarterCounts($leads, $year);

                return true;
            })
            ->values();
    }

    private function getQuarterCounts($leads, int $year): array
    {
        $counts = [
            'Q1' => ['total' => 0, 'offer' => 0],
            'Q2' => ['total' => 0, 'offer' => 0],
            'Q3' => ['total' => 0, 'offer' => 0],
            'Q4' => ['total' => 0, 'offer' => 0],
        ];

        foreach ($leads as $lead) {
            $date = $this->parseDate($lead->joining_date, $lead->updated_at);
            if (!$date || $date->year !== $year) continue;

            $quarter = match (true) {
                $date->month >= 1 && $date->month <= 3 => 'Q1',
                $date->month >= 4 && $date->month <= 6 => 'Q2',
                $date->month >= 7 && $date->month <= 9 => 'Q3',
                $date->month >= 10 && $date->month <= 12 => 'Q4',
            };

            $counts[$quarter]['total']++;

            if ($lead->interview_status == 5) {
                $counts[$quarter]['offer']++;
            }
        }

        return $counts;
    }

    private function parseDate(?string $joiningDate, ?string $updatedAt): ?Carbon
    {
        try {
            if (!empty($joiningDate)) {
                return Carbon::createFromFormat('d-m-Y', trim($joiningDate));
            }
        } catch (\Exception $e) {}

        try {
            return Carbon::parse($updatedAt);
        } catch (\Exception $e) {
            return null;
        }
    }
}
