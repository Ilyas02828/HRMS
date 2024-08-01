<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreviousSalary extends Model
{
    use HasFactory;
    protected $fillable = [
            'employee_id', 'project_id', 'month', 'previous_salary', 'deduct_previous_salary',
            'previous_salary_remaining', 'is_current',
    ];
}
