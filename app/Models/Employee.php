<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
        'verified',
        'department_id'
    ];
    public $timestamps = true;

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }
}
