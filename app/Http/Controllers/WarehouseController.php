<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $warehouses = Warehouse::all();
        $statuses = Status::whereIn('id', [3,4])->get();
        return view('warehouses.index',compact('warehouses','statuses'));
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
        $warehouse = new Warehouse();
        $warehouse->name = $request['name'];
        $warehouse->slug = Str::slug($request['name'], '-');
        $warehouse->status_id = $request['status_id'];
        $warehouse->user_id = $user->id;
        $warehouse->save();

        return redirect()->route('warehouses.index');
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
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->name = $request['name'];
        $warehouse->slug = Str::slug($request['name'], '-');
        $warehouse->status_id = $request['status_id'];
        $warehouse->user_id = $user->id;
        $warehouse->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();
        return redirect()->back();
    }
}
