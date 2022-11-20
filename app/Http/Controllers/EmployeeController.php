<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{

    public function index()
    {
        if(Auth::user()->isAdmin()){
            $employees = Employee::all();
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

    public function store(EmployeeRequest $request)
    {
        if(Auth::user()->isAdmin()){
            $employee = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department_id'=>$request->department_id,
                'email' => $request->email,
                'role'=>$request->role,
                'profile_img'=>$request->profile_img,
                'verified'=>$request->verified,
                'password' => Hash::make($request->password),
            ]);
            return response()->json('Added Successfully', 200);
            //redirect to Employees
        }else{
            //redirect to home
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function showEmployeesProfile(Employee $employee)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
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
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        if(Auth::user()->isAdmin()){
            $employee->update($request->all());
            //redirect to employees
        }
        else{
            //redirect to home
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        if(Auth::user()->isAdmin()){
            $employee->delete();
            //redirect to employees
        }
        else{
            //redirect to home
        }
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
