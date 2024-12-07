<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        $statuses = Status::whereIn('id', [3,4])->get();
        return view('types.index',compact('types','statuses'));
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
            'name' => 'required'
        ]);

        $user = Auth::user();
        $type = new Type();
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name'], '-');
        $type->status_id = $request['status_id'];
        $type->user_id = $user->id;
        $type->save();

        return redirect()->route('types.index');
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
        $user = Auth::user();
        $type = Type::findOrFail($id);
        $type->name = $request['name'];
        $type->slug = Str::slug($request['name'], '-');
        $type->status_id = $request['status_id'];
        $type->user_id = $user->id;
        $type->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $type = Type::findOrFail($id);
        $type->delete();
        return redirect()->back();
    }
}
