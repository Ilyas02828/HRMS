<?php

namespace App\Http\Controllers;
use App\Models\HourlyRate;
use Validator;

use Illuminate\Http\Request;
use App\Models\MonthlySalary;
use App\Models\AdvanceSalary;
use App\Models\department;
use App\Models\PreviousSalary;
use App\Models\Visa;
use App\Models\Project;
use App\Models\Employee;
use DB;
use Brian2694\Toastr\Facades\Toastr;

class MonthlySalaryController extends Controller
{

    public function index()
    {
        $monthlySalaries = MonthlySalary::with('project')->with('employee')->orderBy('created_at', 'DESC')->get();
        $projects = Project::select('id', 'name')->get();
        $employees = Employee::select('id', 'name')->get();
        $depts = department::get();
        return view('salary-month.month-salary', compact('projects','employees','monthlySalaries', 'depts'));
    }

    public function advance_previous(Request $request)
    {

        $previous = PreviousSalary::where('employee_id',$request->employee_id)->where('is_current', 1)->first();

        $advance = AdvanceSalary::where('employee_id',$request->employee_id)->where('is_current', 1)->first();

        $visa = Visa::where('employee_id',$request->employee_id)->where('is_current', 1)->first();

        $data=[
            'previous' => $previous,
            'advance' => $advance,
            'visa' => $visa
        ];

        return response()->json($data);
    }

    public function fetch_hourly_rates(Request $request)
    {
        $hourly_rates = HourlyRate::where('project_id',$request->project_id)->orderBy('employee_type', 'asc')->get();
        return response()->json($hourly_rates);
    }

    public function fetch_hourly_rate(Request $request)
    {
        $hourly_rate = HourlyRate::where('project_id',$request->project_id)->orderBy('employee_type', 'asc')->first();
        return response()->json($hourly_rate);
    }

    public function saveRecord(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'employee_id'           => 'required|string|max:255',
            'project_id'          => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message)
            {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try{
            $employee = new MonthlySalary();
            $employee->month = $request->month;
            $employee->total_month_days = $request->total_month_days;
            $employee->total_absenties = $request->total_absenties;
            $employee->total_holidays = $request->total_holidays;
            $employee->total_working_days = $request->total_working_days;
            $employee->normal_working_hours = $request->normal_working_hours;
            $employee->over_time_hours = $request->over_time_hours;
            $employee->total_hours = $request->total_hours;
            $employee->per_hour_rate = $request->per_hour_rate;
            $employee->vat_15_percent = $request->vat_15_percent;
            $employee->salary = $request->salary;
            $employee->site_insentives = $request->site_insentives;
            $employee->food_allownce = $request->food_allownce;
            $employee->travel_allownce = $request->travel_allownce;
            $employee->dress_ppe_card = $request->dress_ppe_card;
            $employee->medical_allowance = $request->medical_allownce;
            $employee->deduction_food_allownce = $request->deduction_food_allownce;
            $employee->deduction_travel_allownce = $request->deduction_travel_allownce;
            $employee->deduction_dress_ppe_card = $request->deduction_dress_ppe_card;
            $employee->deduc_medical_expense = $request->deduc_medical_expense;

            $employee->total_salary_op = $request->total_salary_op;
            $employee->total_salary = $request->total_salary;
            $employee->salary_paid_to = $request->salary_paid_to;
            $employee->paid_time = $request->paid_time;
            $employee->paid_date = $request->paid_date;
            $employee->trade_01 = $request->trade_01;
            $employee->employee_id = $request->employee_id;
            $employee->project_id = $request->project_id;
            $employee->save();

            if($request->has('deduction_visa_fee') && !empty($request->deduction_visa_fee) ){

                $visa_detail = Visa::where('employee_id',$request->employee_id)->where('is_current', 1)->first();
                $visa_detail->update(['is_current'=>0]);

                $visa = new Visa();
                $visa->employee_id = $request->employee_id;
                $visa->visa_fee = $request->visa_fee_due;
                $visa->visa_deduction = $request->deduction_visa_fee;
                $visa->visa_remaining = $request->visa_fee_old - $request->deduction_visa_fee;
                $visa->save();
            }

            if($request->has('deduct_advance_salary') && !empty($request->deduct_advance_salary) ){

                $advance_detail = AdvanceSalary::where('employee_id',$request->employee_id)->where('is_current', 1)->first();
                $advance_detail->update(['is_current'=>0]);
                $advance = new AdvanceSalary();
                $advance->employee_id =$request->employee_id;
                $advance->project_id = $request->project_id;
                $advance->month = $request->month;
                $advance->advance_salary = $request->advance_salary_due;
                $advance->deduct_advance_salary = $request->deduct_advance_salary;
                $advance->advance_salary_remaining = $request->due_advance_salary - $request->deduct_advance_salary;
                $advance->save();
            }

            if($request->has('previous_salary_due') && !empty($request->previous_salary_due) ){
                $previous_detail = PreviousSalary::where('employee_id',$request->employee_id)->where('is_current', 1)->first();
                $previous_detail->update(['is_current'=>0]);

                $previous= new PreviousSalary();
                $previous->employee_id = $employee->id;
                $previous->project_id = $request->project_id;
                $previous->month = $request->month;
                $previous->previous_salary = $request->previous_salary_due;
                $previous->deduct_previous_salary = $request->deduct_previous_salary;
                $previous->previous_salary_remaining = $request->previous_salary_due - $request->deduct_previous_salary;
                $previous->save();
            }

            DB::commit();
            Toastr::success('Salary added successfully :)','Success');
            return redirect()->route('monthly-salary/list');
        } catch(\Exception $e){
            DB::rollback();
//            Toastr::error($e->getMessage());

            Toastr::error('Salary added fail :)','Error');
            return redirect()->back();
        }
    }


    public function detail($id)
    {

        $Salary = MonthlySalary::with('employee', 'project')->where('id',$id)->first();
        return view('salary-month.detail', compact('Salary'));
    }

}
