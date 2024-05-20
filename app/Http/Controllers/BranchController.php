<?php
// app/Http/Controllers/BranchController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;

use Illuminate\Database\QueryException;
use App\Models\Regional;

class BranchController extends Controller
{
    public function index()
    {

        $branches = Branch::with('region')->orderByDesc('id')->paginate(10);
        $regions = Regional::all();
        $branch = new Branch();
        return view('branches.index', compact('branches', 'regions', 'branch'));
    }


    public function create()
    {
        $regions = Regional::all();
        $branch = new Branch(); // Create a new empty branch object
        return view('branches.create', compact('regions', 'branch'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch_name' => 'required',
            'region_id' => 'required|exists:regions,id',
        ]);

        try {

            $region = Regional::findOrFail($request->input('region_id'));
            $branchName = $region->name;
            Branch::create([
                'name' => $request->input('branch_name'),
                'region_id' => $request->input('region_id'),
                'name_regions' => $branchName,

            ]);
            return redirect()->route('branches.index')->with('success', 'Cabang created successfully.');
        } catch (\Exception $e) {
            return redirect()->route('branches.index')->with('error', 'Failed to create Cabang.');
        }
    }



    public function edit(Branch $branch)
    {
        $regions = Regional::all();
        return view('branches.edit', compact('branch', 'regions'));
    }


    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'branch_name' => 'required',
            'region_id' => 'required|exists:regions,id',
        ]);

        $branch->update([
            'name' => $request->input('branch_name'),
            'region_id' => $request->input('region_id'),
        ]);
  dd( $branch);
        return redirect()->route('branches.index')->with('success', 'Cabang updated successfully.');
    }



    public function destroy(Branch $branch)
    {
        try {
            $branch->delete();

            return redirect()->route('branches.index')
                ->with('success', 'Cabang deleted successfully');
        } catch (QueryException $e) {
            return redirect()->back()->withErrors(['error' => 'Error deleting regional: ' . $e->getMessage()]);
        }
    }



    public function getBranchesByRegion(Request $request)
    {
        $nameRegionsId = $request->input('nameRegionsId');

        $branches = Branch::where('name_regions', $nameRegionsId)->get();

        return response()->json($branches);
    }
}
