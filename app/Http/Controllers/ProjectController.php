<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use DB;
use Validator;
use Brian2694\Toastr\Facades\Toastr;
use App\Models\MonthlySalary;
use App\Models\Employee;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = DB::table('projects')->get();
        return view('form.project.projects',compact('projects'));
    }

    public function create()
    {
        //
    }

    // employee search
    public function projectSearch(Request $request)
    {
        $projects = DB::table('projects');

        if ($request->has('name') && $request->filled('name')) {
            $projects = $projects->where('name', $request->name);
        }

        $projects = $projects->get();

        return view('form.project.projects',compact('projects'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
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
            $project = Project::where('name',$request->name)->first();
            if ($project === null)
            {
                $project = new Project;
                $project->name = $request->name;
                $project->manager = $request->manager;
                $project->start_date = $request->start_date;
                $project->address = $request->address;
                $project->contact = $request->contact;
                $project->save();

                DB::commit();
                Toastr::success('Add new project successfully :)','Success');
                return redirect()->route('projects/list');
            } else {
                DB::rollback();
                Toastr::error('Add new project exits :)','Error');
                return redirect()->back();
            }
        }catch(\Exception $e){
            DB::rollback();
            Toastr::error('Add new project fail :)','Error');
            return redirect()->back();
        }
    }

    public function show(Project $project)
    {
        //
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255',
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
        $project = [
            'id'=>$request->id,
            'name'=>$request->name,
            'manager' => $request->manager,
            'start_date' => $request->start_date,
            'address' => $request->address,
            'contact' => $request->contact
        ];
        Project::where('id',$request->id)->update($project);

        DB::commit();
        Toastr::success('updated record successfully :)','Success');
        return redirect()->route('projects/list');
    } catch(\Exception $e) {
        DB::rollback();
        Toastr::error('updated record fail :)','Error');
        return redirect()->back();
    }
    }

    public function deleteRecord(Request $request)
    {
        try {

            Project::destroy($request->id);
            Toastr::success('Project deleted successfully :)','Success');
            return redirect()->back();

        } catch(\Exception $e) {

            DB::rollback();
            Toastr::error('Project delete fail :)','Error');
            return redirect()->back();
        }
    }


        public function employees(Request $request, $id)
    {

        $salaryMonth = MonthlySalary::where('project_id', $id)->get();
        $employeeIds = $salaryMonth->pluck('employee_id')->toArray();
        $empList = Employee::whereIn('id', $employeeIds)->get();
        return view('form.project.projectemployees',compact('empList'));
    }
}
