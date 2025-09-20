<?php

namespace App\Http\Controllers\PerformanceDashboard;

use App\Http\Controllers\Controller;
use App\Models\PerformanceDashboard\CreateTargetModel;
use App\Models\Company\Technology;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class CreateTargetController extends Controller
{
    /**
     * Show the form and target list.
     */
    // public function index()
    // {
    //     $targets = CreateTargetModel::with('technology')
    //         ->orderBy('year', 'desc')
    //         ->orderBy('quarter')
    //         ->get();

    //     $technologies = Technology::where('technology_status', 1)->get();

    //     return view('performancedashboard.CreateTarget', compact('targets', 'technologies'));
    // }


public function index()
{
    $currentYear = Carbon::now()->year;

    // Step 1: Get all active technologies
    $technologies = Technology::where('technology_status', 1)->get();

    // Step 2: Loop over each technology, shift, quarter
    foreach ($technologies as $technology) {
        foreach (['Day', 'Night'] as $shift) {
            foreach ([1, 2, 3, 4] as $quarter) {
                $teamname = $technology->technology_id . '|' . $shift;

                // Step 3: Check if entry exists
                $exists = DB::table('technology_targets')
                    ->where('technology_id', $technology->technology_id)
                    ->where('shift', $shift)
                    ->where('quarter', $quarter)
                    ->where('year', $currentYear)
                    ->exists();

                // Step 4: Insert if not exists
                if (!$exists) {
                    DB::table('technology_targets')->insert([
                        'technology_id' => $technology->technology_id,
                        'teamname' => $teamname,
                        'shift' => $shift,
                        'quarter' => $quarter,
                        'year' => $currentYear,
                        'target' => 0,
                        'achieved' => 0,
                        'status' => 'Enabled', 
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }

    // Continue with your normal logic
    $targets = CreateTargetModel::with('technology')
        ->orderBy('year', 'desc')
        ->orderBy('quarter')
        ->get();

    return view('performancedashboard.CreateTarget', compact('targets', 'technologies'));
}


    /**
     * Store a new technology target.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'quarter' => 'required|integer|min:1|max:4',
            'target' => 'required|integer',
            'teamname' => 'required|string|max:255',
            // 'achieved' => 'nullable|integer|min:0',
            'year' => 'required|integer|min:2020|max:' . date('Y'),
        ]);

        [$technology_id, $shift] = explode('|', $request->teamname);

        // Prevent duplicates
        $exists = CreateTargetModel::where('technology_id', $technology_id)
            ->where('shift', $shift)
            ->where('year', $request->year)
            ->where('quarter', $request->quarter)
            ->exists();

        if ($exists) {
            return redirect()->back()->withInput()->with('error', 'Target already exists for this team and quarter.');
        }

        CreateTargetModel::create([
            'technology_id' => $technology_id,
            'shift' => $shift,
            'teamname' => $request->teamname,
            'quarter' => $request->quarter, // <-- this line is MISSING in your error stack
            'year' => $request->year,
            'target' => $request->target,
            'achieved' => $request->achieved ?? 0,
        ]);

        return redirect()->route('performancedashboard.index')->with('success', 'Target created successfully.');
    }

    /**
     * Edit a specific target.
     */
    public function edit(CreateTargetModel $technology_target)
    {
        $targets = CreateTargetModel::with('technology')
            ->orderBy('year', 'desc')
            ->orderBy('quarter')
            ->get();

        $technologies = Technology::where('technology_status', 1)->get();

        return view('performancedashboard.CreateTarget', compact('targets', 'technologies', 'technology_target'));
    }


    /**
     * Update an existing technology target.
     */
    public function update(Request $request, CreateTargetModel $technology_target)
    {
        $request->validate([
            'quarter' => 'required|integer|min:1|max:4',
            'target' => 'required|integer',
            'teamname' => 'required|string|max:255',
            'achieved' => 'nullable|integer|min:0',
            'year' => 'required|integer|min:2020|max:' . date('Y'),
            'status' => 'required|in:Enabled,Disabled',
        ]);

        [$technology_id, $shift] = explode('|', $request->teamname);

        $technology_target->update([
            'technology_id' => $technology_id,
            'shift' => $shift,
            'teamname' => $request->teamname,
            'quarter' => $request->quarter,
            'year' => $request->year,
            'target' => $request->target,
            'achieved' => $request->achieved ?? 0,
            'status' => $request->status, 
        ]);

        return redirect()->route('performance.targets.index')->with('success', 'Target updated successfully!');
    }


    /**
     * Delete a technology target.
     */
    public function destroy(CreateTargetModel $technology_target)
    {
        $technology_target->delete();

        return redirect()->route('performance.targets.index')->with('success', 'Target deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $target = CreateTargetModel::findOrFail($id);
        $target->status = $target->status === 'Enabled' ? 'Disabled' : 'Enabled';
        $target->save();

        return redirect()->back()->with('success', 'Status updated successfully!');
    }

}
