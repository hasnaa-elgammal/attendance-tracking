<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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
            $newImageName = $request->profile_img->extension();
            $request->profile_img->move(public_path('images\profile_images'), $newImageName);
            $employee = Employee::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'department_id'=>$request->department_id,
                'email' => $request->email,
                'role'=>$request->role,
                'profile_img'=>$newImageName,
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
    public function update(EmployeeRequest $request, $employee_Id)
    {
        if(Auth::user()->isAdmin()){
            $employee=Employee::find($employee_Id);
            $imageName = $employee->profile_img;
            if($request->has('profile_img')){
                $imageName =$request->profile_img->extension();
                $request->profile_img->move(public_path('images\profile_images'), $imageName);
            }
            if(is_null($employee)){
                return response()->json('employee not Found', 404);
            }
            $employee->first_name = $request->first_name;
            $employee->last_name = $request->last_name;
            $employee->email = $request->email;
            $employee->department_id=$request->department_id;
            $employee->password = Hash::make($request->password);
            $employee->role =$request->role;
            $employee->profile_img=$imageName;
            $employee->verified = $request->verified;
            if($employee->save()) {
                return redirect()->route('Employees.index')->with('success','employee Has Been updated successfully');
            }
            return response()->json('Can not Edit the employee', 400);
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

    public function showEmployeesProfile($employee_Id){
        if(Auth::user()->isAdmin() || (Auth::user()->isHead() && Auth::user()->department_id == $department_id)){
            $employees = Employee::where('id', $employee_Id)
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img','department_id')->get();
            //return view
        }else{
            //redirect to home
        }

    }

    public function showEmployeesProfileByDepartment($employee_Id,$department_id){
        if(Auth::user()->isAdmin() || (Auth::user()->isHead() && Auth::user()->department_id == $department_id)){
            $employees = Employee::where('id', $employee_Id)
            ->where('department_id', $department_id)
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img','department_id')
            ->get();
            //return view
        }else{
            //redirect to home
        }

    }
    public function availableEmployees()
    {
        if(Auth::user()->isAdmin()){
            $emloyees = DB::table('check_in_outs')->join('employees', 'employees.id', '=', 'check_in_outs.employee_id')
            ->select('employees.id', 'employees.first_name', 'employees.last_name','check_in_outs.check_in')
            ->where('check_in_outs.date', date("Y-m-d"))
            ->where('check_in_outs.check_out', null)->get();
            // return view
        }else{
            //redirect to home
        }
    }

    public function showEmployeesAbsenceDays($employee_Id){
        if(Auth::user()->isAdmin()){
            $employees = Employee::where('id', $employee_Id)
            ->join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img', 'check_in_outs.date')
            ->where('check_in_outs.check_in', null)->get();

            $employeesCount = Employee::where('id', $employee_Id)
            ->join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img', 'check_in_outs.date')
            ->where('check_in_outs.check_in', null)->count();

            //return view
        }else{
            //redirect to home
        }

    }

    public function showEmployeesAbsenceDaysByDepartment($employee_Id,$department_id){
        if(Auth::user()->isAdmin() || (Auth::user()->isHead() && Auth::user()->department_id == $department_id)){

            $employees = Employee::where('department_id', $department_id)
            ->join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img', 'check_in_outs.check_in')
            ->where('employees.id',$employee_Id)
            ->where('check_in_outs.check_in', null)->get();

            $employeesCount = Employee::where('department_id', $department_id)
            ->join('check_in_outs', 'check_in_outs.employee_id', 'employees.id')
            ->select('employees.id', 'first_name', 'last_name', 'email', 'profile_img', 'check_in_outs.check_in')
            ->where('employees.id',$employee_Id)
            ->where('check_in_outs.check_in', null)->count();

            //return view
        }else{
            //redirect to home
        }

    }



}


