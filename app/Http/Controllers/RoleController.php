<?php

namespace App\Http\Controllers;

use App\Models\Stage;
use App\Models\Status;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.index', compact('roles', 'statuses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.create',compact('statuses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $role = new Role();


        $role->name = $request->name;
        $role->slug = Str::slug($request->name, '-');
        $role->status_id = $request->status_id;
        $role->user_id = Auth::id();

//        single image upload
        if(file_exists($request->file('image'))){
            $image = $request->file('image');
            //$fname = uniqid().'.'.$image->getClientOriginalExtension(); //only to get extension
//           $fname = uniqid().'.'.$image->getClientOriginalName(); //only to get name
            //you can do as it, that was what I tested.

            //sayar tin steps // these steps are only to change img name
            $fname = $image->getClientOriginalName();
            $newimgname = uniqid().'-'.Auth::user()->name.'-'.$fname;

//            file move to public folder
            $image->move(public_path('assets/img/roles/'), $newimgname);
//            save in the database this file path name
            $role->image = "assets/img/roles/".$newimgname;
        }

        $role->save();

        return redirect()->route('roles.index');
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
        $role = Role::findOrFail($id);
        $statuses = Status::whereIn('id',[3,4])->get();
        return view('roles.edit', compact('role', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = Auth::user();
        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->slug = Str::slug($request->name, '-');
        $role->status_id = $request->status_id;
        $role->user_id = Auth::id();

//        two steps for image update
//        -delete old photo if new image file exists in file input
//        -update or upload new image

//        first step
        if($request->hasFile('image')){
            $path = $role->image;
            if(File::exists($path)){
                File::delete($path);
            }
        }

//        second step
        if(file_exists($request->file('image'))){
            $image = $request->file('image');
            $fname = $image->getClientOriginalName();
            $newimgname = uniqid().'-'.Auth::user()->name.$fname;
            $image->move(public_path('assets/img/roles/'), $newimgname);
            $role->image = "assets/img/roles/".$newimgname;
        }

        $role->save();

        return redirect()->route('roles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

        //Remove old single image
//        remove is only one step, look for path in the file and delete
        $path = $role->image;
//        to get directly to public folder File method is used
        if(File::exists($path)){
            File::delete($path);
        }

        $role->delete();
        return redirect()->back();
    }
}
