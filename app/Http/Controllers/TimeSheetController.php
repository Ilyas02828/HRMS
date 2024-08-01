<?php

namespace App\Http\Controllers;

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
use App\Models\TimeSheet;
use App\Models\Project;
use App\Models\module_permission;

class TimeSheetController extends Controller
{
    public function punch()
    {
        $empList = DB::table('employees')->get();
        $employees = DB::table('employees')->get();
        $projects = DB::table('projects')->get();
        $timesheet = TimeSheet::with('employee')->with('project')->get();

        $title = 'Delete Punch Detail!';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);

        return view('timesheet.list', compact('empList', 'projects', 'employees', 'timesheet'));
    }

    public function punchin(Request $request)
    {
        DB::beginTransaction();
        try {
            $validatorTime = Validator::make($request->all(), [
                'deduction_time' => 'nullable|max:5'

            ])->validateWithBag('validatorTime');

            $rules = [
                'punchin' => 'required',
                'employee_id' => 'required',
                'project_id' => 'required'
            ];

            $messages = [
                'punchin.required' => 'Time in field is required!',
                'punchout.required' => 'Time Out field is required!',
                'employee_id.required' => 'employee_id field is required!'
            ];
            $validated = $this->validate($request, $rules, $messages, $validatorTime);


            $employeepunch = new TimeSheet();
            $employeepunch->project_id = $validated['project_id'];
            $employeepunch->employee_id = $validated['employee_id'];
            $employeepunch->punchin = $validated['punchin'];
            $employeepunch->punchout = $request->punchout;
            $employeepunch->shift = $request->shift;
            $employeepunch->trade = $request->trade;

            $start = strtotime($validated['punchin']);
            $end = strtotime($request->punchout);


            if ($end < $start && $request->punchout !== null) {
                throw ValidationException::withMessages(['punch_out' => 'PunchOut time must be greater than PunchIn.']);
            } else {

                $hours = intval(($end - $start) / 3600);   // Total Hours
                if ($end == '') {
                    $hours = 0;
                }
                $employeepunch->today_hours = $hours;
            }

            $employeepunch->save();

            Toastr::success('Punch created successfully:)', 'Success');

            DB::commit();
            return redirect()->route('punch');
        } catch (Exception $exception) {
            DB::rollBack();
            Toastr($this->flasherInstance, $exception->getMessage());
            return back()->withInput();
        }

    }

    public function delete(Request $request)
    {
        try {

            TimeSheet::destroy($request->id);
            Toastr::success('Punch Detail deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Punch Detail delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function import()
    {

        return view('timesheet.import');

    }

    public function download_template()
    {
        $file = 'TimesheetImportV1.csv'; // The name of your CSV file

        $filePath = storage_path('app/csv/' . $file);

        if (file_exists($filePath)) {
            return response()->download($filePath, $file, [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $file . '"',
            ]);
        } else {
            return response()->json(['message' => 'File not found'], 404);
        }
    }

    public function importcsv(Request $request)
    {
        DB::beginTransaction();

        try {

            $file = $request->file('csv');

            // Check if a file was uploaded
            if ($file) {

                $path = $file->getRealPath();

                // Read the CSV data
                $item = array_map('str_getcsv', file($path));
                $i = 0;
                foreach ($item as $data) {
                    $i++;

                    $employeepunch = new TimeSheet();
                    $employeepunch->project_id = $data[0];
                    $employeepunch->employee_id = $data[1];
                    $employeepunch->punchin = $data[2];
                    $employeepunch->punchout = $data[3];
                    $employeepunch->shift = $data[4];
                    $employeepunch->trade = $data[5];

                    $start = strtotime($data[2]);
                    $end = strtotime($data[3]);
                    $hours = intval(($end - $start) / 3600);   // Total Hours
                    if ($end == '') {
                        $hours = 0;
                    }
                    $employeepunch->today_hours = $hours;
                    $employeepunch->save();

                    Toastr::success($i . ' Employees TimeSheet imported successfully:)', 'Success');

                    DB::commit();
                    return redirect()->route('punch');

                    FlasherHelper::flasherSuccess($this->flasherInstance, $i . ' employee imported successfully');
                    DB::commit();
                    return redirect()->route('employees.index');
                }
            }
        } catch (Exception $exception) {
            DB::rollBack();
            Toastr($this->flasherInstance, $exception->getMessage());
            return back()->withInput();
        }
    }
    public function timesheetreports(Request $request)
    {

        $startDate = $request->datefrom;
        $endDate = $request->dateto;

        $empList = DB::table('employees')->get();
        $employees = DB::table('employees')->get();
        $projects = DB::table('projects')->get();
        $timesheet = TimeSheet::with('employee')->with('project');

        if ($request->has('employee_id') && $request->filled('employee_id')) {
            $timesheet = $timesheet->where('employee_id', $request->employee_id);
        }

        if ($request->has('datefrom') && $request->filled('datefrom')) {
            $timesheet = $timesheet->whereBetween('punchin', [$startDate, $endDate . ' 23:59:59']);

        }

        $timesheet = $timesheet->get();

        return view('reports.timesheetreports', compact('empList', 'projects', 'employees', 'timesheet'));
    }
}
