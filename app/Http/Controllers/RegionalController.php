<?php

namespace App\Http\Controllers;

use App\Models\Regional;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;


class RegionalController extends Controller
{
    public function index()
    {
        $regionals = Regional::all();
        return view('regions.index', compact('regionals'));
    }

    public function create()
    {
        return view('regions.create_modal');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:regions|max:255',
        ]);

        Regional::create($request->all());

        return redirect()->route('regions.index')
            ->with('success', 'Regional created successfully.');
    }

    public function edit(Regional $regional)
    {
        return view('regions.edit_modal', compact('regional'));
    }

    public function update(Request $request, Regional $regional)
    {
          $request->validate([
                'title' => 'required',
            ]);

            $regional->update([
                'title' => $request->input('title'),
            ]);
            
            //   $regional->update($request->all());
            //   dd( $regional);
            return redirect()->route('regions.index')->with('success', 'Regional updated successfully');
    }




   public function destroy(Regional $regional)
{
    try {
        $regional->delete();
        return redirect()->route('regions.index')->with('success', 'Regional deleted successfully');
    } catch (\Exception $e) {
        return redirect()->route('regions.index')->with('error', 'Failed to delete regional: ' . $e->getMessage());
    }
}



}
