<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdvanceSalary extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id', 'project_id', 'month', 'advance_salary',
        'deduct_advance_salary', 'advance_salary_remaining', 'is_current'];
}
