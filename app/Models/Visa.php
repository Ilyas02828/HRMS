<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable = ['employee_id', 'visa_fee', 'visa_deduction', 'visa_remaining', 'is_current'];
    public function employees()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
