<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LeavingRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LeavingRequestRequest;

class LeavingRequestController extends Controller
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeavingRequestRequest $request)
    {
        LeavingRequest::create([
            'employee_id'=> Auth::user()->id,
            'reason'=> $request->reason,
            'leaving_time' => date("Y-m-d H:i:s", strtotime($request->leaving_time))
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LeavingRequest  $leavingRequest
     * @return \Illuminate\Http\Response
     */
    public function show(LeavingRequest $leavingRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LeavingRequest  $leavingRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(LeavingRequest $leavingRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LeavingRequest  $leavingRequest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LeavingRequest $leavingRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LeavingRequest  $leavingRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(LeavingRequest $leavingRequest)
    {
        //
    }
}
