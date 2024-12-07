<?php

namespace App\Http\Controllers;

use App\Models\Gender;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class GenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $genders = Gender::all();
        $statuses = Status::all();
        return view('genders.index', compact('genders', 'statuses'));
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
        $gender = new Gender();
        $gender->name = $request->name;
        $gender->slug = Str::slug($request->name,'-');
        $gender->status_id = $request->status_id;
        $gender->user_id = Auth::user()->id;
        $gender->save();
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
        $gender = Gender::findOrFail($id);
        $gender->name = $request->name;
        $gender->slug = Str::slug($request->name,'-');
        $gender->status_id = $request->status_id;
        $gender->user_id = Auth::user()->id;
        $gender->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gender = Gender::findOrFail($id);
        $gender->delete();
        return redirect()->back();
    }
}
