<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmployeeController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }

    public function allEmployeesByDepartment($department_id){
        if(Auth::user()->isAdmin() || (Auth::user()->isHead() && Auth::user()->department_id == $department_id)){
            $employees = Employee::select('id', 'first_name', 'last_name', 'email', 'profile_img')
            ->where('department_id', $department_id)->get();
            //return view
        }else{
            //redirect to home
        }
    }

    public function availableEmployeesByDepartment($department_id){

        if(Auth::user()->isAdmin() || (Auth::user()->isHead() && Auth::user()->department_id == $department_id)){
            $employees = Employee::where('department_id', $department_id)
            ->join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img', 'check_in_outs.check_in')
            ->where('check_in_outs.date', date("Y-m-d"))
            ->where('check_in_outs.check_out', null)->get();
            //return view
            //join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
        }else{
            //redirect to home
        }
    }
}
