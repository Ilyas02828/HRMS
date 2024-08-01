<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpenseCredit;
use App\Models\ProjectExpenseDebit;
use Illuminate\Http\Request;
use DB;
use Validator;
use Brian2694\Toastr\Facades\Toastr;

class ProjectExpenseController extends Controller
{

    public function index()
    {
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        //
    }

    public function indexCredit(Request $request)
    {
        $credits = ProjectExpenseCredit::with('projects');

        if ($request->has('project_filter') && $request->filled('project_filter')) {
            $credits = $credits->where('project_id', $request->project_filter);
        }
        if ($request->has('month_filter') && $request->filled('month_filter')) {
            $credits = $credits->where('month', $request->month_filter);
        }
        if ($request->filled('date_from_filter') && !$request->filled('date_from_filter')) {
            $credits = $credits->where('date', '>=', date('Y-m-d', strtotime($request->date_from_filter)));
        }
        if (!$request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $credits = $credits->where('date', '<=', date('Y-m-d', strtotime($request->date_to_filter)));
        }
        if ($request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $from = date('Y-m-d', strtotime($request->date_from_filter));
            $to = date('Y-m-d', strtotime($request->date_to_filter));

            $credits = $credits->whereBetween('date', [$from, $to]);
        }
        if ($request->has('status_filter') && $request->filled('status_filter')) {
            $credits = $credits->where('status', $request->status_filter);
        }

        $expenseCredits = $credits->orderBy('created_at', 'DESC')->get();
        $projects = Project::all();
        return view('form.project-expenses.project-credit', compact('expenseCredits', 'projects'));
    }

    public function storeCredit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'invoice_number' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {

            $projectExpense = new ProjectExpenseCredit();
            $projectExpense->project_id = $request->project_id;
            $projectExpense->invoice_number = $request->invoice_number;
            $projectExpense->month = $request->month;
            $projectExpense->date = date('Y-m-d', strtotime($request->date));
            $projectExpense->amount = $request->amount;
            $projectExpense->status = $request->status;
            $projectExpense->save();

            DB::commit();
            Toastr::success('Add new Project Credit Expense created successfully :)', 'Success');
            return redirect()->route('projects/project-expense-credit/index');

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new project expense fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function updateCredit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'invoice_number' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $project = [
                'project_id' => $request->project_id,
                'invoice_number' => $request->invoice_number,
                'month' => $request->month,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->amount,
                'status' => $request->status
            ];
            ProjectExpenseCredit::where('id', $request->id)->update($project);

            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('projects/project-expense-credit/index');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('updated record fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function deleteRecordCredit(Request $request)
    {
        try {

            ProjectExpenseCredit::destroy($request->id);
            Toastr::success('Project Credit Expense deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Project credit expense delete fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function indexDebit(Request $request)
    {
        $debits = ProjectExpenseDebit::with('projects');

        if ($request->has('project_filter') && $request->filled('project_filter')) {
            $debits = $debits->where('project_id', $request->project_filter);
        }
        if ($request->has('month_filter') && $request->filled('month_filter')) {
            $debits = $debits->where('month', $request->month_filter);
        }
        if ($request->filled('date_from_filter') && !$request->filled('date_from_filter')) {
            $debits = $debits->where('date', '>=', date('Y-m-d', strtotime($request->date_from_filter)));
        }
        if (!$request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $debits = $debits->where('date', '<=', date('Y-m-d', strtotime($request->date_to_filter)));
        }
        if ($request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $from = date('Y-m-d', strtotime($request->date_from_filter));
            $to = date('Y-m-d', strtotime($request->date_to_filter));

            $debits = $debits->whereBetween('date', [$from, $to]);
        }

        $expenseDebits = $debits->orderBy('created_at', 'DESC')->get();

        $projects = Project::all();
        return view('form.project-expenses.project-debit', compact('expenseDebits', 'projects'));
    }

    public function storeDebit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'date' => 'required',
            'month' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $projectExpense = new ProjectExpenseDebit();
            $projectExpense->project_id = $request->project_id;
            $projectExpense->month = $request->month;
            $projectExpense->date = date('Y-m-d', strtotime($request->date));
            $projectExpense->amount = $request->amount;
            $projectExpense->description = $request->description;
            $projectExpense->save();

            DB::commit();
            Toastr::success('Add new Project Debit Expense created successfully :)', 'Success');
            return redirect()->route('project-expense-debit/index');

        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new project expense fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function updateDebit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_id' => 'required',
            'month' => 'required',
            'date' => 'required',
            'amount' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $message) {
                Toastr::error($message, 'Error');
            }
            return redirect()->back();
        }

        DB::beginTransaction();
        try {
            $project = [
                'project_id' => $request->project_id,
                'month' => $request->month,
                'date' => date('Y-m-d', strtotime($request->date)),
                'amount' => $request->amount,
                'description' => $request->description
            ];
            ProjectExpenseDebit::where('id', $request->id)->update($project);

            DB::commit();
            Toastr::success('updated record successfully :)', 'Success');
            return redirect()->route('projects/project-expense-debit/index');
        } catch (\Exception $e) {
            DB::rollback();
            Toastr::error('Add new project expense fail :)', 'Error');
            return redirect()->back();
        }
    }

    public function deleteRecordDebit(Request $request)
    {
        try {

            ProjectExpenseDebit::destroy($request->id);
            Toastr::success('Project Debit Expense deleted successfully :)', 'Success');
            return redirect()->back();

        } catch (\Exception $e) {

            DB::rollback();
            Toastr::error('Project delete fail :)', 'Error');
            return redirect()->back();
        }
    }

}
