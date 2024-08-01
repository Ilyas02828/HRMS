<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectExpenseCredit;
use App\Models\ProjectExpenseDebit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ExpenseReportsController extends Controller
{
    // view page
    public function index(Request $request)
    {
        $month = '';
        $project = '';
        $sum_debit  = 0;
        $sum_credit = 0;
        $paid_credit = 0;
        $unpaid_credit = 0;
        $projects = Project::all();
        $requestData = $request->all();
        $credits = ProjectExpenseCredit::with('projects');
        $debits = ProjectExpenseDebit::with('projects');

        if ($request->has('project_filter') && $request->filled('project_filter')) {
            $credits = $credits->where('project_id', $request->project_filter);
            $debits = $debits->where('project_id', $request->project_filter);
        }
        if ($request->has('month_filter') && $request->filled('month_filter')) {
            $credits = $credits->where('month', $request->month_filter);
            $debits = $debits->where('month', $request->month_filter);
        }
        if ($request->filled('date_from_filter') && !$request->filled('date_from_filter')) {
            $credits = $credits->where('date', '>=', date('Y-m-d', strtotime($request->date_from_filter)));
            $debits = $debits->where('date', '>=', date('Y-m-d', strtotime($request->date_from_filter)));
        }
        if (!$request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $credits = $credits->where('date', '<=', date('Y-m-d', strtotime($request->date_to_filter)));
            $debits = $debits->where('date', '<=', date('Y-m-d', strtotime($request->date_to_filter)));
        }
        if ($request->filled('date_from_filter') && $request->filled('date_to_filter')) {
            $from = date('Y-m-d', strtotime($request->date_from_filter));
            $to = date('Y-m-d', strtotime($request->date_to_filter));

            $credits = $credits->whereBetween('date', [$from, $to]);
            $debits = $debits->whereBetween('date', [$from, $to]);
        }



        if (!empty($requestData) && count($requestData) > 0){
            $expenseCredit = $credits->select(DB::raw("SUM(amount) as total_amount_credit"))
                ->selectRaw('SUM(CASE WHEN status = "1" THEN amount ELSE 0 END) as sum_paid_amount_credit')
                ->selectRaw('SUM(CASE WHEN status = "0" THEN amount ELSE 0 END) as sum_unpaid_amount_credit')
                ->first();
            $project = Project::find($request->project_filter);
            $month = $request->month_filter;
            $sum_credit = $expenseCredit->sum_unpaid_amount_credit;
            $paid_credit =$expenseCredit->sum_paid_amount_credit;
            $unpaid_credit = $expenseCredit->total_amount_credit;

            $expenseDebit = $debits->select(DB::raw("SUM(amount) as total_debit"))->first();
            $sum_debit = $expenseDebit->total_debit;

            return view('reports.expense-report', compact('sum_credit','paid_credit','unpaid_credit','sum_debit','project', 'month', 'projects'));
        }else{
            return view('reports.expense-report', compact('sum_credit','paid_credit','unpaid_credit','sum_debit','project', 'month', 'projects'));
        }
    }

    // view page
    public function invoiceReports()
    {
        return view('reports.invoicereports');
    }
    // daily report page
    public function dailyReport()
    {
        return view('reports.dailyreports');
    }

    // leave reports page
    public function leaveReport()
    {
        $leaves = DB::table('leaves_admins')
            ->join('users', 'users.user_id', '=', 'leaves_admins.user_id')
            ->select('leaves_admins.*', 'users.*')
            ->get();
        return view('reports.leavereports', compact('leaves'));
    }
}
