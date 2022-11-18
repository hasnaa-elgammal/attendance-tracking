<?php

namespace App\Models;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LeavingRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'reason',
        'status',
    ];
    public $timestamps = true;

    public function employee(){
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}