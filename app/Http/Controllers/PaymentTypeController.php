<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paymentTypes = PaymentType::all();
        $statuses = Status::whereIn('id', [ 3,4])->get();
        return view('payment-types.index', compact('paymentTypes', 'statuses'));
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
        $paymentType = new PaymentType();
        $paymentType->name = $request->name;
        $paymentType->slug = Str::slug($request->name,'-');
        $paymentType->status_id =$request->status_id;
        $paymentType->user_id = $user->id;
        $paymentType->save();

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
        $user = Auth::user();
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->name = $request->name;
        $paymentType->slug = Str::slug($request->name,'-');
        $paymentType->status_id =$request->status_id;
        $paymentType->user_id = $user->id;
        $paymentType->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paymentType = PaymentType::findOrFail($id);
        $paymentType->delete();
        return redirect()->back();
    }
}
