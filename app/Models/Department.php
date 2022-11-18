<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'head_id'
    ];
    public $timestamps = true;

    public function head(){
        return $this->hasOne(Employee::class, 'head_id', 'id');
    }
}
