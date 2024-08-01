<?php

namespace App\Http\Controllers;

use App\Models\MonthlySalary;
use App\Models\HourlyRate;
use Validator;
use Illuminate\Http\Request;
use DB;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\Employee;
use App\Models\department;
use App\Models\User;
use App\Models\Visa;
use App\Models\PreviousSalary;
use App\Models\AdvanceSalary;
use App\Models\module_permission;

class EmployeeController extends Controller
{
    // all employee card view
    public function cardAllEmployee(Request $request)
    {
        $empList = DB::table('employees')->get();
        $projects = DB::table('projects')->get();
        $title = 'Delete Employee!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('form.allemployeecard', compact('empList', 'projects'));
    }

    // all employee list
    public function listAllEmployee()
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();
        $userList = DB::table('users')->get();
        $permission_lists = DB::table('permission_lists')->get();
        return view('form.employeelist', compact('users', 'userList', 'permission_lists'));
    }

    public function saveRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
//            'email'          => 'required|string|email|unique:employees',
//            'ecoma_number'   => 'required|string|max:255|unique:employees',
//            'employee_id'   => 'required|string|unique:employees,ecoma_number,'.$request->id,
//            'ecoma_type'     => 'required|string|max:255',
//            'ecoma_expiry'   => 'required|string|max:255',
//            'contact'        => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->ecoma_number = $request->ecoma_number;
            $employee->ecoma_type = $request->ecoma_type;
            $employee->ecoma_expiry = $request->ecoma_expiry;
            $employee->employee_id = $request->employee_id;
            $employee->contact = $request->contact;
            $employee->nationality = $request->nationality;
            $employee->job_title = $request->job_title;
            $employee->company_site = $request->company_site;
            $employee->bank_name_code = $request->bank_name_code;
            $employee->bank_address = $request->bank_address;
            $employee->account = $request->account;
            $employee->save();

            if ($request->has('due_visa_fee') && !empty($request->due_visa_fee)) {
                $visa = new Visa();
                $visa->employee_id = $employee->id;
                $visa->visa_fee = $request->total_visa_fee;
                $visa->visa_remaining = $request->due_visa_fee;
                $visa->save();
            }

            if ($request->has('due_advance_salary') && !empty($request->due_advance_salary)) {
                $advance = new AdvanceSalary();
                $advance->employee_id = $employee->id;
                $advance->project_id = $request->project_id_advance;
                $advance->month = $request->advance_salary_month;
                $advance->advance_salary = $request->due_advance_salary;
                $advance->advance_salary_remaining = $request->due_advance_salary;
                $advance->save();
            }

            if ($request->has('due_previous_salary') && !empty($request->due_previous_salary)) {
                $previous = new PreviousSalary();
                $previous->employee_id = $employee->id;
                $previous->project_id = $request->project_id_previous;
                $previous->month = $request->previous_salary_month;
                $previous->previous_salary = $request->due_previous_salary;
                $previous->previous_salary_remaining = $request->due_previous_salary;
                $previous->save();
            }
            DB::commit();
            Toastr::success('Add new employee successfully :)', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new employee fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function saveRecordold(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
//                'email'          => 'required|string|email|unique:employees',
//                'ecoma_number'   => 'required|string|max:255|unique:employees',
//                'employee_id'   => 'required|string|unique:employees,ecoma_number,'.$request->id,
//                'ecoma_type'     => 'required|string|max:255',
//                'ecoma_expiry'   => 'required|string|max:255',
//                'contact'        => 'required|string|max:255',
        ]);


        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $employee = new Employee;
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->ecoma_number = $request->ecoma_number;
            $employee->ecoma_type = $request->ecoma_type;
            $employee->ecoma_expiry = $request->ecoma_expiry;
            $employee->employee_id = $request->employee_id;
            $employee->contact = $request->contact;
            $employee->nationality = $request->nationality;
            $employee->job_title = $request->job_title;
            $employee->company_site = $request->company_site;
            $employee->bank_name_code = $request->bank_name_code;
            $employee->bank_address = $request->bank_address;
            $employee->account = $request->account;
            $employee->employee_id = $request->employee_id;
            $employee->save();

            DB::commit();
            Toastr::success('Add new employee successfully :)', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new employee fail :)', 'Error');
            return redirect()->back();
        }
    }

    // view edit record
    public function viewRecord($employee_id)
    {
        $permission = DB::table('employees')
            ->join('module_permissions', 'employees.employee_id', '=', 'module_permissions.employee_id')
            ->select('employees.*', 'module_permissions.*')
            ->where('employees.employee_id', '=', $employee_id)
            ->get();
        $employees = DB::table('employees')->where('employee_id', $employee_id)->get();
        return view('form.edit.editemployee', compact('employees', 'permission'));
    }

    public function viewDetail($employee_id)
    {

        $employees = DB::table('employees')->where('id', $employee_id)->first();
        return view('form.employee_detail', compact('employees'));
    }

    // update record employee
    public function updateRecord(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
//            'email'          => 'required|string|email|unique:employees,email,'.$request->id,
//            'ecoma_number'   => 'required|string|unique:employees,ecoma_number,'.$request->id,
//            'employee_id'   => 'required|string|unique:employees,ecoma_number,'.$request->id,
//            'ecoma_type'     => 'required|string|max:255',
//            'ecoma_expiry'   => 'required',
//            'contact'        => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $employee = Employee::findOrFail($request->id);
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->ecoma_number = $request->ecoma_number;
            $employee->ecoma_type = $request->ecoma_type;
            $employee->ecoma_expiry = $request->ecoma_expiry;
            $employee->employee_id = $request->employee_id;
            $employee->contact = $request->contact;
            $employee->nationality = $request->nationality;
            $employee->job_title = $request->job_title;
            $employee->company_site = $request->company_site;
            $employee->bank_name_code = $request->bank_name_code;
            $employee->bank_address = $request->bank_address;
            $employee->account = $request->account;
            $employee->update();
//return $employee;
            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('all/employee/card');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function deleteRecord($employee_id)
    {
        DB::beginTransaction();
        try {

            Employee::where('id', $employee_id)->delete();

            DB::commit();
            Toastr::success('Delete record successfully :)', 'Success');
            return redirect()->route('all/employee/card');

        } catch (\Exception $e) {
            $empList = DB::table('employees')->get();

            DB::rollback();
            Toastr::error('Delete record fail :)', 'Error');
            return redirect()->back();
        }
    }

    // employee search
    public function employeeSearch(Request $request)
    {
        $empList = DB::table('employees');

        if ($request->has('employee_id') && $request->filled('employee_id')) {
            $empList = $empList->where('employee_id', $request->employee_id);
        }

        if ($request->has('name') && $request->filled('name')) {
            $empList = $empList->where('name', $request->name);
        }

        $empList = $empList->get();
        $projects = DB::table('projects')->get();


        return view('form.allemployeecard', compact('empList', 'projects'));
    }

    public function employeeListSearch(Request $request)
    {
        $users = DB::table('users')
            ->join('employees', 'users.user_id', '=', 'employees.employee_id')
            ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
            ->get();
        $permission_lists = DB::table('permission_lists')->get();
        $userList = DB::table('users')->get();

        // search by id
        if ($request->employee_id) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->get();
        }
        // search by name
        if ($request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->get();
        }
        // search by name
        if ($request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')
                ->get();
        }

        // search by name and id
        if ($request->employee_id && $request->name) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->get();
        }
        // search by position and id
        if ($request->employee_id && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')
                ->get();
        }
        // search by name and position
        if ($request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')
                ->get();
        }
        // search by name and position and id
        if ($request->employee_id && $request->name && $request->position) {
            $users = DB::table('users')
                ->join('employees', 'users.user_id', '=', 'employees.employee_id')
                ->select('users.*', 'employees.birth_date', 'employees.gender', 'employees.company')
                ->where('employee_id', 'LIKE', '%' . $request->employee_id . '%')
                ->where('users.name', 'LIKE', '%' . $request->name . '%')
                ->where('users.position', 'LIKE', '%' . $request->position . '%')
                ->get();
        }
        return view('form.employeelist', compact('users', 'userList', 'permission_lists'));
    }

    // employee profile with all controller user
    public function profileEmployee($user_id)
    {
        $users = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', 'users.user_id')
            ->leftJoin('profile_information', 'profile_information.user_id', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->first();
        $user = DB::table('users')
            ->leftJoin('personal_information', 'personal_information.user_id', 'users.user_id')
            ->leftJoin('profile_information', 'profile_information.user_id', 'users.user_id')
            ->where('users.user_id', $user_id)
            ->get();
        return view('form.employeeprofile', compact('user', 'users'));
    }

    /** page departments */
    public function index()
    {
        $departments = DB::table('departments')->get();
        return view('form.departments', compact('departments'));
    }

    /** save record department */
    public function saveRecordDepartment(Request $request)
    {
        $request->validate([
            'department' => 'required|string|max:255',
        ]);

        DB::beginTransaction();
        try {

            $department = department::where('department', $request->department)->first();
            if ($department === null) {
                $department = new department;
                $department->department = $request->department;
                $department->save();

                DB::commit();
                Toastr::success('Add new department successfully :)', 'Success');
                return redirect()->route('form/departments/page');
            } else {
                DB::rollback();
                Toastr::error('Add new department exits :)', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new department fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** update record department */
    public function updateRecordDepartment(Request $request)
    {
        DB::beginTransaction();
        try {
            // update table departments
            $department = [
                'id' => $request->id,
                'department' => $request->department,
            ];
            department::where('id', $request->id)->update($department);

            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('form/departments/page');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** delete record department */
    public function deleteRecordDepartment(Request $request)
    {
        try {

            department::destroy($request->id);
            Toastr::success('Department deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Department delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** page designations */
    public function designationsIndex()
    {
        return view('form.designations');
    }

    /** page time sheet */
    public function timeSheetIndex()
    {
        return view('form.timesheet');
    }

    /** page overtime */
    public function overTimeIndex()
    {
        return view('form.overtime');
    }

    /** page hourly-rate */
    public function RecordHourlyRate()
    {
        $hourly_rates = HourlyRate::with('projects')->get();
        $projects = DB::table('projects')->get();
        return view('form.hourlyRate.index', compact('hourly_rates', 'projects'));
    }

    /** save record hourly-rate */
    public function saveRecordHourlyRate(Request $request)
    {
        $request->validate([
            'employee_type' => 'required|string|max:255',
            'project' => 'required',
            'hourly_rate' => 'required',
        ]);

        DB::beginTransaction();
        try {

            $hourly_rate = HourlyRate::where('hourly_rate', $request->hourly_rate)
                ->where('employee_type', $request->employee_type)
                ->where('project_id', $request->project)->first();

            if ($hourly_rate === null) {
                $hourly_rate = new HourlyRate();
                $hourly_rate->project_id = $request->project;
                $hourly_rate->employee_type = $request->employee_type;
                $hourly_rate->hourly_rate = $request->hourly_rate;
                $hourly_rate->save();

                DB::commit();
                Toastr::success('Add new hourly rate successfully :)', 'Success');
                return redirect()->route('form/hourly-rate/page');
            } else {
                DB::rollback();
                Toastr::error('Hourly rate exits :)', 'Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new hourly rate fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** update record hourly-rate */
    public function updateRecordHourlyRate(Request $request)
    {
        $request->validate([
            'employee_type' => 'required|string|max:255',
            'project' => 'required',
            'hourly_rate' => 'required',
        ]);

        DB::beginTransaction();
        try {
            // update table departments
            $hourly_rate = [
                'id' => $request->id,
                'employee_type' => $request->employee_type,
                'hourly_rate' => $request->hourly_rate,
                'project_id' => $request->project,
            ];
            HourlyRate::where('id', $request->id)->update($hourly_rate);

            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('form/hourly-rate/page');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)', 'Error');
            return redirect()->back();
        }
    }

    /** delete record hourly-rate */
    public function deleteRecordHourlyRate(Request $request)
    {
        try {
            HourlyRate::destroy($request->id);
            Toastr::success('Hourly rate deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Hourly rate delete fail :)', 'Error');
            return redirect()->back();
        }
    }



}
