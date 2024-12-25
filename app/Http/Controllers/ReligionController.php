<?php

namespace App\Http\Controllers;

use App\Models\Religion;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ReligionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $religions = Religion::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('religions.index', compact('religions','statuses'));
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
            'status_id' => 'nullable|integer',
        ]);

        $religion = new Religion();
        $religion->name = $request->name;
        $religion->slug = Str::slug($request->name,'-');
        $religion->status_id = $request->status_id;
        $religion->user_id = Auth::id();
        $religion->save();

        return redirect()->route('religions.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $religion = Religion::findOrFail($id);
        $religion->delete();
        return redirect()->back();
    }
}
