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
                        <h3 class="page-title">Monthly Salary</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Salary</li>
                        </ul>

                        <div class="run_report_btn" style="float: right; font-weight: bolder"> Export in
                            <button class="btn btn-warning" onclick="ExportToExcel('xlsx')" >Excel</button>
                            <button onclick="ExportToCsv('csv');" class="btn btn-info">CSV</button>
                            <button onclick="printdiv('printDiv');" class="btn btn-success">Print</button>
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_salary"><i class="fa fa-plus"></i> Add Salary</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            <!-- Search Filter -->
            <form action="{{ route('monthly-salary/list') }}" method="GET">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-focus select-focus">
                            <select class="select  select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_filter" name="project_filter" >
                                <option value=""> Select Project</option>
                                @foreach ($projects as $key=>$project )
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Employee </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4">
                        <div class="form-group form-focus select-focus">
                            <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_filter" name="employee_filter">
                                <option value="">-- Select --</option>
                                @foreach ($employees as $key=>$employee )
                                    <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Employee </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="month_filter" class="form-control floating month-year" type="text">
                            </div>
                            <label class="focus-label">Month</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <button type="sumit" class="btn btn-success btn-block"> Search</button>
                    </div>
                </div>
            </form>



            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row" id="printDiv">
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
                            @php $i=1; @endphp
                            @foreach ($monthlySalaries as $monthlySalary )
                                <tr>
                                    <td>{{ $i++ }}</td>
                                    <td  class="employee_job_title">{{ $monthlySalary->month }}</td>
                                    <td  class="employee_company_site">{{ !empty($monthlySalary->project->name) ? $monthlySalary->project->name : '' }}</td>
                                    <td  class="employee_company_site">{{ !empty($monthlySalary->employee->name) ? $monthlySalary->employee->name : '' }}</td>
                                     <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item" href="{{ url('monthly-salary/detail/'.$monthlySalary->id) }}"><i class="fa fa-eye m-r-5"></i> Detail</a>
{{--                                                <a class="dropdown-item  edit_employee" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>--}}
                                                <a class="dropdown-item delete_employee" href="#" data-toggle="modal" data-target="#delete_employee"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
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
                        <form action="{{ route('monthly-salary/save') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Month/Project/Employee </h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Month </label>
                                        <input type="text" class="form-control month-year"  id="month" name="month" placeholder="i.e Jan-2024" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Project </label>
                                        <select class="select select2s-hidden-accessible project" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_id" name="project_id" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($projects as $key=>$project )
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee Type </label>
                                        <select class="select select2s-hidden-accessible hourlyRate" style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_type" name="employee_type" required>
                                        <option value="">-- Select --</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Employee </label>
                                        <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_id" name="employee_id" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($employees as $key=>$employee )
                                                <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Month Days </label>
                                        <input type="text" class="form-control" id="total_month_days" onkeyup="workingDays()" name="total_month_days" placeholder="Total days in month" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Absenties</label>
                                        <input type="text" class="form-control" onkeyup="updateWorkingDays()" id="total_absenties" name="total_absenties" placeholder="Total Absenties">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Holidays</label>
                                        <input type="text" class="form-control" onkeyup="updateWorkingDays()" id="total_holidays" name="total_holidays" placeholder="Total Holidays">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Working Days </label>
                                        <input type="text" class="form-control"  id="total_working_days" name="total_working_days" placeholder="Total working days" readonly>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Normal Working Hours </label>
                                        <input type="text" class="form-control" onkeyup="updateWorkingHours()"  id="normal_working_hours" name="normal_working_hours" placeholder="Normal Working Hours" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Over Time Hours</label>
                                        <input type="text" class="form-control" onkeyup="updateWorkingHours()" id="over_time_hours" name="over_time_hours" placeholder="Over Time Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Total working Hours</label>
                                        <input type="text" class="form-control" id="total_hours" name="total_hours" placeholder="Total Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Per Hour Rate</label>
                                        <input type="text" class="form-control" onkeyup="updateSalary()" id="per_hour_rate" name="per_hour_rate" placeholder="Per Hour Rate">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">VAT 15 percent </label>
                                        <input type="text" class="form-control" onkeyup="updateSalary()" id="vat_15_percent" name="vat_15_percent" placeholder="VAT 15 percent">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Salary </label>
                                        <input type="text" readonly class="form-control" id="salary" name="salary" placeholder="Salary">
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
                                        <label class="col-form-label"> Site Insentives</label>
                                        <input type="text" class="form-control"  onkeyup="overAllSalary()" id="site_insentives" name="site_insentives" placeholder="Site Insentives">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Food  </label>
                                        <input type="text" class="form-control" onkeyup="overAllSalary()"  id="food_allownce" name="food_allownce" placeholder="Food Allownce" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Travel  </label>
                                        <input type="text" class="form-control" onkeyup="overAllSalary()"  id="travel_allownce" name="travel_allownce" placeholder="Travel Allownce">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">PPE & Dress  </label>
                                        <input type="text" class="form-control" onkeyup="overAllSalary()"  id="dress_ppe_card" name="dress_ppe_card" placeholder="Dress & PPE Card">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Medical  </label>
                                        <input type="text" class="form-control" onkeyup="overAllSalary()"  id="medical_allownce" name="medical_allownce" placeholder="Medical Allownce">
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
                                        <label class="col-form-label"> Deduction Food </label>
                                        <input type="text" class="form-control" id="deduction_food_allownce" onkeyup="overAllDeduction()" name="deduction_food_allownce" placeholder="Deduction Food ">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Travel </label>
                                        <input type="text" class="form-control" id="deduction_travel_allownce" onkeyup="overAllDeduction()" name="deduction_travel_allownce" placeholder="Deduction Travel ">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction PPE & Dress</label>
                                        <input type="text" class="form-control" id="deduction_dress_ppe_card" onkeyup="overAllDeduction()" name="deduction_dress_ppe_card" placeholder="Deduction PPE & Dress" >
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Visa Fee Due</label>
                                        <input type="text" class="form-control" readonly id="visa_fee_old" name="visa_fee_due" placeholder="Visa Fee Due">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Visa Fee </label>
                                        <input type="text" class="form-control" readonly="readonly" id="deduction_visa_fee" onkeyup="overAllDeduction()" name="deduction_visa_fee" placeholder="Deduction Visa Fee">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Medical Expense </label>
                                        <input type="text" class="form-control" id="deduc_medical_expense" onkeyup="overAllDeduction()" name="deduc_medical_expense" placeholder="Deduction Medical Expense">
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
                                        <label class="col-form-label"> Advance Salary Month </label>
                                        <input type="text" class="form-control" readonly id="advance_salary_month" name="advance_salary_month" placeholder=" Advance Due Salary month">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Advance Due Salary </label>
                                        <input type="text" class="form-control" readonly id="advance_salary_due" name="advance_salary_due" placeholder=" Advance Due Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduct Advance Salary </label>
                                        <input type="text" class="form-control" id="deduct_advance_salary" name="advance_salary" placeholder=" Advance Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Previous Salary Month</label>
                                        <input type="text" class="form-control" readonly id="previous_salary_month" name="previous_salary_month" placeholder="Previous Due Salary Month">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Previous Due Salary </label>
                                        <input type="text" class="form-control" readonly id="previous_salary_due" name="previous_salary_due" placeholder="Previous Due Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Deduct Previous Salary </label>
                                        <input type="text" class="form-control" id="deduct_previous_salary" name="deduct_previous_salary" placeholder="Previous Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary OP </label>
                                        <input type="text" class="form-control" id="total_salary_op" name="total_salary_op" placeholder="Total Salary OP">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary </label>
                                        <input type="text" class="form-control" id="total_salary" name="total_salary" placeholder="Total Salary" required>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Salary Paid To </label>
                                        <input type="text" class="form-control" id="salary_paid_to" name="salary_paid_to" placeholder="Salary Paid To">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Time </label>
                                        <input type="Time" class="form-control" id="paid_time" name="paid_time" placeholder="Paid Time">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Date </label>
                                        <input type="Date" class="form-control" id="paid_date" name="paid_date" placeholder="Paid Date">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label"> Trade 01 </label>
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

    </div>

    <!-- /Page Wrapper -->
@section('script')
<script>
    $(function() {
        $('.month-year').datetimepicker({
            viewMode: 'months',
            format: 'YYYY-MM'
        });
    });
</script>
<script>
    $(".project").on('change',function(e){
        e.preventDefault(e);
        var hourlyRate =$(".hourlyRate");
        $.ajax({
            type:'GET',
            url: "{{ route('fetch-hourly-rates') }}",
            data:{project_id : $(this).find(":selected").val()},
            success:function(response){
                $('option', hourlyRate).remove();
                $('.hourlyRate').append('<option value="">select</option>');
                $.each(response, function(){
                    $('<option/>', {
                        'value': this.id,
                        'text': this.employee_type
                    }).appendTo('.hourlyRate');
                });
            }
        });
    });


    $(".hourlyRate").on('change',function(e){
        e.preventDefault(e);

        $.ajax({
            type:'GET',
            url: "{{ route('fetch-hourly-rate') }}",
            data:{project_id : $('.project').find(":selected").val(), rate_id : $(this).find(":selected").val()},
            success:function(response){
                $('#per_hour_rate').val(response.hourly_rate);
            }
        });
    });


    $('#employee_id').change(function () {
        var employee_id = $('#employee_id :selected').val();
        console.log('hit')
        $.ajax({
            type:'GET',
            url:"{{ route('fetch-advance-previous') }}",
            dataType: 'json',
            data:{employee_id:employee_id},
            success:function(data){
                if (data.advance !== null && data.advance.advance_salary_remaining !== null &&
                    data.advance.advance_salary_remaining !== undefined) {
                    $('#advance_salary_due').val(data.advance.advance_salary_remaining);
                    $('#advance_salary_month').val(data.advance.month);
                }

                if (data.previous !== null && data.previous.previous_salary_remaining !== null &&
                    data.previous.previous_salary_remaining !== undefined) {
                    $('#previous_salary_due').val(data.previous.previous_salary_remaining);
                    $('#previous_salary_month').val(data.previous.month);
                }

                if (data.visa !== null && data.visa.visa_remaining !== null &&
                    data.visa.visa_remaining !== undefined) {
                    $('#visa_fee_old').val(data.visa.visa_remaining);
                    $('#deduction_visa_fee').removeAttr('readonly');
                }
            }
        });

    });

    function workingDays() {
        $('#total_working_days').val($('#total_month_days').val());
    }

    function updateWorkingDays() {
        // Get the values from the input fields
        var totalMonthDays = document.getElementById('total_month_days').value;
        var totalAbsences = document.getElementById('total_absenties').value;
        var totalHolidays = document.getElementById('total_holidays').value;

        // Perform the calculation
        var totalWorkingDays = totalMonthDays - totalAbsences - totalHolidays;

        // Display the result in the totalWorkingDays input field
        document.getElementById('total_working_days').value = totalWorkingDays;
    }

    function updateWorkingHours() {
            // Get the values from the input fields
            var totalRegularHours = parseFloat(document.getElementById('normal_working_hours').value) || 0;
            var overtimeHours = parseFloat(document.getElementById('over_time_hours').value) || 0;
        var totalWorkingDays  =  document.getElementById('total_working_days').value;

            // Perform the calculation
        var totalWorkingHoursMonthly = totalRegularHours * totalWorkingDays;

        var totalWorkingHours = totalWorkingHoursMonthly + overtimeHours;

            // Display the result in the totalWorkingHours input field
            document.getElementById('total_hours').value = totalWorkingHours;
        }


    function updateSalary() {
        // Get the values from the input fields
        var ratePerHours = parseFloat(document.getElementById('per_hour_rate').value) || 0;
        var vatPercent = parseFloat(document.getElementById('vat_15_percent').value) || 0;
        var totalWorkingHours  = document.getElementById('total_hours').value;

        // Perform the calculation
        var totalSalary = ratePerHours * totalWorkingHours;

        var vatPercentage = (vatPercent / 100) * totalSalary;
        var totalAllSalary = vatPercentage + totalSalary;
        document.getElementById('salary').value = totalAllSalary;
    }

    function overAllSalary() {
        // Get the values from the input fields and convert them to numbers
        var siteInsentive = parseFloat(document.getElementById('site_insentives').value) || 0;
        var foodAllowance = parseFloat(document.getElementById('food_allownce').value) || 0;
        var travelAllowance = parseFloat(document.getElementById('travel_allownce').value) || 0;
        var dressPpecard = parseFloat(document.getElementById('dress_ppe_card').value) || 0;
        var medicalAllownce = parseFloat(document.getElementById('medical_allownce').value) || 0;

        var totalAllSalary = parseFloat(document.getElementById('salary').value) || 0;
        var totalOverAllAllowances = siteInsentive + foodAllowance + travelAllowance + dressPpecard + medicalAllownce;

        // Display the result in the totalWorkingDays input field
        $('#total_salary').val(totalAllSalary + totalOverAllAllowances);
    }


    function overAllDeduction() {
        var deduction_food_allownce = parseFloat($('#deduction_food_allownce').val()) || 0;
        var deduction_travel_allownce = parseFloat($('#deduction_travel_allownce').val()) || 0;
        var deduction_dress_ppe_card = parseFloat($('#deduction_dress_ppe_card').val()) || 0;
        var deduction_visa_fee = parseFloat($('#deduction_visa_fee').val()) || 0;
        var deduc_medical_expense = parseFloat($('#deduc_medical_expense').val()) || 0;

        var totalAllSalary = parseFloat($('#salary').val()) || 0;
        var totalOverAllDeduction = deduction_food_allownce + deduction_travel_allownce + deduction_dress_ppe_card + deduction_visa_fee + deduc_medical_expense;

        $('#total_salary').val(totalAllSalary - totalOverAllDeduction);
    }

    function calculate_op() {
        var total_salary_op = parseFloat($('#total_salary_op').val()) || 0;
        var deduction_travel_allownce = parseFloat($('#deduction_travel_allownce').val()) || 0;

        var totalAllSalary = parseFloat($('#salary').val()) || 0;
        var totalOverAllDeduction = deduction_food_allownce + deduction_travel_allownce + deduction_dress_ppe_card + deduction_visa_fee + deduc_medical_expense;

        $('#total_salary').val(totalAllSalary - totalOverAllDeduction);
    }
</script>

<script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
<script>
    function printdiv(printpage) {
        var headstr = "<html><head><title></title></head><body>";
        var footstr = "</body>";
        var newstr = document.all.item(printpage).innerHTML;
        var oldstr = document.body.innerHTML;
        document.body.innerHTML = headstr + newstr + footstr;
        window.print();
        document.body.innerHTML = oldstr;
        return false;
    }

    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('printDiv');
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: "sheet1"
        });
        return dl ?
            XLSX.write(wb, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            }) :
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')));
    }

    function ExportToCsv(type, fn, dl) {
        var elt = document.getElementById('printDiv');
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: "sheet1"
        });
        return dl ?
            XLSX.write(wb, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            }) :
            XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'csv')));
    }
</script>
@endsection
@endsection
