<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    public function technologyList()
    {
        $technologys = Technology::all();
        return view('company.technology', compact('technologys'));
    }

    public function addTechnology(Request $request)
    {
        $request->validate([
            'technology_name' => 'required|string|max:255',
            'tech_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->has('technology_id')) {
            $technology = Technology::find($request->input('technology_id'));
            if (!$technology) {
                return redirect()->route('add.technology')->with('error', 'Technology not found!');
            }

            $technology->technology_name = $request->input('technology_name');
            $technology->technology_status = $request->input('technology_status');

            if ($request->hasFile('tech_image')) {
                $imageName = Str::random(10) . '.' . $request->tech_image->extension();
                $request->tech_image->move(public_path('uploads/technology'), $imageName);
                $technology->tech_image = 'uploads/technology/' . $imageName;
            }

            $technology->save();

            return redirect()->route('add.technology')->with('success', 'Technology updated successfully!');
        } else {
            $technology = new Technology();
            $technology->technology_name = $request->input('technology_name');
            $technology->technology_status = true;

            if ($request->hasFile('tech_image')) {
                $imageName = Str::random(10) . '.' . $request->tech_image->extension();
                $request->tech_image->move(public_path('uploads/technology'), $imageName);
                $technology->tech_image = 'uploads/technology/' . $imageName;
            }

            $technology->save();

            return redirect()->back()->with('success', 'Technology added successfully!');
        }
    }

    public function editTechnology($id)
    {
        $technologys = Technology::all();
        $editTechnology = Technology::find($id);
        return view('company.technology', compact('editTechnology', 'technologys'));
    }

    public function destroy($id)
    {
        $Technology = Technology::find($id);
        $Technology->delete();

        return redirect()->route('add.technology')->with('success', 'Technology deleted successfully.');
    }
}

