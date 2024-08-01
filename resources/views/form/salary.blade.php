@extends('layouts.master')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Project</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Project</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
                    </div>
                </div>
            </div>

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>Month</th>
                                <th>Project </th>
                                <th>Employee</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->



        <!-- Modal goes here -->
        <!-- Add Employee Month Salary Modal -->
        <div id="add_salary" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Employee Monthly Salary</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('all/employee/save') }}" method="POST">
                            @csrf


                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Month/Project/Employee </h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Month <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="month" name="month" placeholder="i.e Jan-2024" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Project</label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_id" name="project_id">
                                            <option value="">-- Select --</option>
                                            @foreach ($projects as $key=>$project )
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee</label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_id" name="employee_id">
                                            <option value="">-- Select --</option>
                                            @foreach ($employees as $key=>$employee )
                                                <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Month Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_month_days" name="total_month_days" placeholder="Total days in month" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Absenties <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_absenties" name="total_absenties" placeholder="Total Absenties">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Holidays <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_holidays" name="total_holidays" placeholder="Total Holidays">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Working Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_working_days" name="total_working_days" placeholder="Total working days">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Normal Working Hours <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="normal_working_hours" name="normal_working_hours" placeholder="Normal Working Hours" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Over Time Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="over_time_hours" name="over_time_hours" placeholder="Over Time Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Total working Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_hours" name="total_hours" placeholder="Total Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Per Hour Rate<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="per_hour_rate" name="per_hour_rate" placeholder="Per Hour Rate">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">VAT 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_15_percent" name="vat_15_percent" placeholder="VAT 15 percent">
                                    </div>
                                </div>
                                <!-- <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">VAT without 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_without_15_percent" name="vat_without_15_percent" placeholder="VAT without 15 percent">
                                    </div>
                                </div> -->
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">
                                    </div>
                                </div>

                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Allowance Information</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Site Insentives<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="site_insentives" name="site_insentives" placeholder="Site Insentives">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Food  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="food_allownce" name="food_allownce" placeholder="Food Allownce" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Travel  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="travel_allownce" name="travel_allownce" placeholder="Travel Allownce">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Visa Fee<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="visa_fee" name="visa_fee" placeholder="Visa Fee">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">PPE & Dress  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="dress_ppe_card" name="dress_ppe_card" placeholder="Dress & PPE Card">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Medical  <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="medical_allownce" name="medical_allownce" placeholder="Medical Allownce">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Deduction Information</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Food <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_food_allownce" name="deduction_food_allownce" placeholder="Deduction Food ">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Travel Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_travel_allownce" name="deduction_travel_allownce" placeholder="Deduction Travel ">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction PPE & Dress<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_dress_ppe_card" name="deduction_dress_ppe_card" placeholder="Deduction PPE & Dress" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Visa Fee <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_visa_fee" name="deduction_visa_fee" placeholder="Deduction Visa Fee">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Medical Expense<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduc_medical_expense" name="deduc_medical_expense" placeholder="Deduction Medical Expense">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Salary Information</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Advance Salary<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="advance_salary" name="advance_salary" placeholder=" Advance Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Remaining Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="remaining_salary" name="remaining_salary" placeholder="Remaining  Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Previous Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="previous_salary" name="previous_salary" placeholder="Previous Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary OP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary_op" name="total_salary_op" placeholder="Total Salary OP">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary" name="total_salary" placeholder="Total Salary ">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Salary Paid To<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary_paid_to" name="salary_paid_to" placeholder="Salary Paid To">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Time <span class="text-danger">*</span></label>
                                        <input type="Time" class="form-control" id="paid_time" name="paid_time" placeholder="Paid Time">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Date <span class="text-danger">*</span></label>
                                        <input type="Date" class="form-control" id="paid_date" name="paid_date" placeholder="Paid Date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Trade 01<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="trade_01" name="trade_01" placeholder="Trade 01">
                                    </div>
                                </div>
                            </div>

                            <div class="submit-section">
                                <button class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add Employee Modal -->

    </div>

    <!-- /Page Wrapper -->
@section('script')


@endsection
@endsection
