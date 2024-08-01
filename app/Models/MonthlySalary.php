<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlySalary extends Model
{
    use HasFactory;

    protected $fillable  = [
        'employee_id',
        'project_id',
        'employee_manual_id',
        'employee_type_id',
        'month',
        'total_month_days',
        'total_holidays',
        'deduction_dress_ppe_card',
        'dress_ppe_card',
        'medical_allowance',
        'total_working_days',
        'total_absenties',
        'normal_working_hours',
        'over_time_hours',
        'total_hours',
        'per_hour_rate',
        'site_insentives',
        'total_salary',
        'vat_15_percent',
        'food_allownce',
        'deduction_food_allownce',
        'ppe_card_deduction',
        'travel_allownce',
        'deduction_travel_allownce',
        'salary',
        'deduc_medical_expense',
        'total_salary_op',
        'salary_paid_to',
        'paid_time',
        'paid_date',
        'trade_01',
    ];


    public function project()
    {
        return $this->belongsTo(Project::class, 'project_id');
    }
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
    public function employee_type()
    {
        return $this->belongsTo(HourlyRate::class, 'employee_type_id');
    }
}
