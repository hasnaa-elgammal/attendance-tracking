<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\DepartmentRequest;

class DepartmentController extends Controller
{
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $departments = Department::all();
            //return view
        }else{
            //redirect to home
        }
    }

    public function create()
    {
        if(Auth::user()->isAdmin()){
            //return view
        }else{
            //redirect to home
        }
    }

    public function store(DepartmentRequest $request)
    {
        if(Auth::user()->isAdmin()){
            $department = Department::create($request->all());
            //redirect to deparments
        }else{
            //redirect to home
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        if(Auth::user()->isAdmin()){
            //return view
        }else{
            //redirect to home
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, Department $department)
    {
        if(Auth::user()->isAdmin()){
            $department->update($request->all());
            //redirect to departments
        }
        else{
            //redirect to home
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(Department $department)
    {
        if(Auth::user()->isAdmin){
            $department->delete();
            //redirect to departments
        }
        else{
            //redirect to home
        }


    }
}
