<?php

namespace App\Http\Controllers;

use App\Models\Day;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DayController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $days = Day::all();
        $statuses = Status::all();
        return view('days.index', compact('days', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $day = new Day();
        $day->name = $request->name;
        $day->slug = Str::slug($request->name,'-');
        $day->user_id = Auth::user()->id;
        $day->status_id = $request->status_id;
        $day->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $day = Day::findOrFail($id);
        $day->name = $request->name;
        $day->slug = Str::slug($request->name,'-');
        $day->user_id = Auth::user()->id;
        $day->status_id = $request->status_id;
        $day->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $day = Day::findOrFail($id);
        $day->delete();
        return redirect()->back();
    }
}
