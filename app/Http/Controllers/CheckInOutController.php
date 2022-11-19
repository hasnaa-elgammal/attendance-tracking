<?php

namespace App\Http\Controllers;

use App\Models\CheckInOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CheckInOut::create([
            'employee_id'=>Auth::user()->id,
            'date'=> date("Y-m-d"),
            'time'=>date("H:i:s")
        ]);
        //redirect
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CheckInOut  $checkInOut
     * @return \Illuminate\Http\Response
     */
    public function show(CheckInOut $checkInOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CheckInOut  $checkInOut
     * @return \Illuminate\Http\Response
     */
    public function edit(CheckInOut $checkInOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CheckInOut  $checkInOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $checkIn = CheckInOut::where('employee_id', Auth::user()->id)
        ->where('date', date("Y-m-d"))->firstOrFails();

        if($checkIn){
            $checkIn->check_out = date("H:i:s");
            $checkIn->save();
        }
        //redirect
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CheckInOut  $checkInOut
     * @return \Illuminate\Http\Response
     */
    public function destroy(CheckInOut $checkInOut)
    {
        //
    }
}
