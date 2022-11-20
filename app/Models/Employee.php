<?php

namespace App\Models;

use App\Models\CheckInOut;
use App\Models\Department;
use App\Models\LeavingRequest;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
        'department_id',
        'profile_img'
    ];
    public $timestamps = true;

    public function department(){
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function checkInOuts(){
        return $this->hasMany(CheckInOut::class);
    }

    public function leavingRequests(){
        return $this->hasMany(LeavingRequest::class);
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
