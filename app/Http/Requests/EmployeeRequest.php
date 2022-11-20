<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->isAdmin();
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'first_name'=> ['required', 'min:2', 'max:25'],
            'last_name'=> ['required', 'min:2', 'max:25'],
            'email'=> ['required', 'min:2'],
            'password'=> ['required', 'min:2'],
            'role'=> ['required'],
            'verified'=> ['required'],
            'department_id'=> ['required'],
        ];
    }
}
