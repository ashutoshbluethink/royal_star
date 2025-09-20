<?php

namespace App\Services\PerformanceDashboard;

use App\Models\User\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InterviewMemberService
{
public function getInterviewMembersWithQuarterCounts(int $year)
{
    return User::where('role', 3)
        ->where('user_status', 1)
        ->get()
        ->filter(function ($member) use ($year) {
            // Get all leads for this member (for the given year only)
            $allLeads = DB::table('leads')
                ->where('interviewee_id', $member->user_id)
                ->get()
                ->filter(function ($lead) use ($year) {
                    $date = $this->parseDate($lead->joining_date, $lead->updated_at);
                    return $date && $date->year === $year;
                });

            if ($allLeads->isEmpty()) return false;

            // Separate leads
            $offerLeads = $allLeads->where('interview_status', 5);

            // Assign total counts
            $member->totalLeadsCount = $allLeads->count();
            $member->offerLeadCount = $offerLeads->count();

            // Assign quarter-wise counts
            $member->quarterCounts = $this->getQuarterCounts($offerLeads, $year);        // status 5 only
            $member->quarterTotalCounts = $this->getQuarterCounts($allLeads, $year);     // all statuses

            return true;
        })
        ->values();
}


    private function getQuarterCounts($leads, int $year): array
    {
        $counts = ['Q1' => 0, 'Q2' => 0, 'Q3' => 0, 'Q4' => 0];

        foreach ($leads as $lead) {
            $date = $this->parseDate($lead->joining_date, $lead->updated_at);
            if (!$date || $date->year !== $year) continue;

            $quarter = match (true) {
                $date->month >= 1 && $date->month <= 3 => 'Q1',
                $date->month >= 4 && $date->month <= 6 => 'Q2',
                $date->month >= 7 && $date->month <= 9 => 'Q3',
                $date->month >= 10 && $date->month <= 12 => 'Q4',
            };

            $counts[$quarter]++;
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
