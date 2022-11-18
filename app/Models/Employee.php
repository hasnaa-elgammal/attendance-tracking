<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
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

    public function isAdmin(){
        if($this->role == 'admin'){
            return true;
        }
        else{
            return false;
        }
    }

    public function isHead(){
        if($this->role == 'head'){
            return true;
        }
        else{
            return false;
        }
    }

    public function isVerified(){
        return $this->verified;
    }
}
