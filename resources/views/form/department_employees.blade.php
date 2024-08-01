@extends('layouts.master')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper">
    <!-- Page Content -->
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-lists-center">
                <div class="col">
                    <h3 class="page-title">Employee</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                        <li class="breadcrumb-item active">Employee</li>
                    </ul>
                </div>
                <div class="col-auto float-right ml-auto">
                    <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_employee"><i class="fa fa-plus"></i> Add Employee</a>
                    <div class="view-icons">
                        <a href="{{ route('all/employee/card') }}" class="grid-view btn btn-link active"><i class="fa fa-th"></i></a>
                        <a href="{{ route('all/employee/list') }}" class="list-view btn btn-link"><i class="fa fa-bars"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        {!! Toastr::message() !!}
        <!-- Search Filter -->
        <form action="{{ route('all/employee/search') }}" method="POST">
            @csrf
            <div class="row filter-row">
                <div class="col-sm-4 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="employee_id">
                        <label class="focus-label">Employee ID</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="name">
                        <label class="focus-label">Employee Name</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <div class="form-group form-focus">
                        <input type="text" class="form-control floating" name="position">
                        <label class="focus-label">Position</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-3">
                    <button type="sumit" class="btn btn-success btn-block"> Search </button>
                </div>
            </div>
        </form>


        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped custom-table datatable">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Unique Id/ Ecoma Number</th>
                            <th>Ecoma Type</th>
                            <th>Ecoma Expiry Date</th>
                            <th>Email  </th>
                            <th>Mobile</th>
                            <th>Nationality</th>
                            <th class="text-right">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($empList as $key=>$employee )
                        <tr >
                            <td>{{ ++$key }}</td>
                            <td hidden class="id">{{ $employee->id }}</td>
                            <td hidden class="employee_job_title">{{ $employee->job_title }}</td>
                            <td hidden class="employee_company_site">{{ $employee->company_site }}</td>
                            <td hidden class="employee_bank_name_code">{{ $employee->bank_name_code }}</td>
                            <td hidden class="employee_account">{{ $employee->account }}</td>
                            <td hidden class="employee_bank_address">{{ $employee->bank_address }}</td>


                            <td class="employee_name">{{ $employee->name }}</td>
                            <td class="employee_ecoma_number">{{ $employee->ecoma_number }}</td>
                            <td class="employee_ecoma_type">{{ $employee->ecoma_type }}</td>
                            <td class="employee_ecoma_expiry">{{ $employee->ecoma_expiry }}</td>
                            <td class="employee_email">{{ $employee->email }}</td>
                            <td class="employee_contact">{{ $employee->contact }}</td>
                            <td class="employee_nationality">{{ $employee->nationality }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ url('all/employee/view/detail/'.$employee->id) }}"><i class="fa fa-eye m-r-5"></i> Detail</a>
                                        <a class="dropdown-item  edit_employee" href="#" data-toggle="modal" data-target="#edit_employee"><i class="fa fa-pencil m-r-5"></i> Edit</a>
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
    </div>
</div>
</div>
<!-- /Page Content -->

<!-- Add Employee Modal -->
<div id="add_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('all/employee/save') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Basic Information</h4>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="name" name="name" placeholder="Employee Full Name">
                            </div>
                        </div>

                        <div class="col-sm-4"  style="display: none;">
                            <div class="form-group">
                                <label class="col-form-label">Employee Unique ID <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_id" name="employee_id" placeholder="Employee Unique ID">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"> Unique ID/ Ecoma Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="ecoma_number" name="ecoma_number" placeholder="Ecoma Number">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Ecoma Type <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="ecoma_type" name="ecoma_type" placeholder="Ecoma Type">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"> Ecoma Expiry <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="ecoma_expiry" name="ecoma_expiry" placeholder="Ecoma Expiry">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Nationality <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="nationality" name="nationality" placeholder="Nationality">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Company / Site <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="    " name="company_site" placeholder="Company / Site">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Contact <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="contact" name="contact" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="email" name="email" placeholder="Auto email">
                            </div>
                        </div>
                    </div>


                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Bank Details</h4>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Bank Name , Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bank_name_code" name="bank_name_code" placeholder="Bank Name Code">
                            </div>
                        </div>
                        <div class="col-sm-4"  style="display: none">
                            <div class="form-group">
                                <label class="col-form-label"> Bank Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="Bank Address">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"> Account<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="account" name="account" placeholder="Bank Account">
                            </div>
                        </div>
                    </div>
                    <hr>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- /Add Employee Modal -->



<!-- Update Employee Modal -->
<div id="edit_employee" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('all/employee/update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="e_id" value="">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Basic Information</h4>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_name" name="name" placeholder="Employee Full Name">
                            </div>
                        </div>
{{--                        <div class="col-sm-4">--}}
{{--                            <div class="form-group" style="display: none">--}}
{{--                                <label class="col-form-label">Employee Unique ID <span class="text-danger">*</span></label>--}}
{{--                                <input class="form-control" type="text" id="employee_employee_id" name="employee_employee_id" placeholder="Employee Unique ID">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Unique ID / Ecoma Number <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_ecoma_number" name="ecoma_number" placeholder="Ecoma Number">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Ecoma Type <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_ecoma_type" name="ecoma_type" placeholder="Ecoma Type">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label"> Ecoma Expiry <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="employee_ecoma_expiry" name="ecoma_expiry" placeholder="Ecoma Expiry">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Job Title <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_job_title" name="job_title" placeholder="Job Title">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Company / Site <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_company_site" name="company_site" placeholder="Company / Site">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Contact <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_contact" name="contact" placeholder="Contact Number">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" id="employee_email" name="email" placeholder="Auto email">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Nationality <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="employee_nationality" name="nationality" placeholder="Nationality">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Bank Details</h4>
                        </div>
                        <div class="col-sm-4">
                            <div class="form-group">
                                <label class="col-form-label">Bank Name Code, Address <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_bank_name_code" name="bank_name_code" placeholder="Bank Name Code">
                            </div>
                        </div>
                        <div class="col-sm-4" style="display: none">
                            <div class="form-group">
                                <label class="col-form-label"> Bank Address<span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_bank_address" name="bank_address" placeholder="Bank Address">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label"> Account<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="employee_account" name="account" placeholder="Bank Account">
                        </div>
                    </div>
            </div>
            <div class="submit-section">
                <button class="btn btn-primary submit-btn">Update</button>
            </div>
        </div>

        </form>
    </div>
</div>
</div>
</div>
<!-- /Add Employee Modal -->


</div>
<!-- /Page Wrapper -->
@section('script')

{{-- update js --}}
<script>
    $(document).on('click','.edit_employee',function()
    {
        var _this = $(this).parents('tr');
        $('#e_id').val(_this.find('.id').text());
        $('#employee_name').val(_this.find('.employee_name').text());
        $('#employee_ecoma_number').val(_this.find('.employee_ecoma_number').text());
        $('#employee_ecoma_type').val(_this.find('.employee_ecoma_type').text());
        $('#employee_ecoma_expiry').val(_this.find('.employee_ecoma_expiry').text());
        $('#employee_email').val(_this.find('.employee_email').text());
        $('#employee_contact').val(_this.find('.employee_contact').text());
        $('#employee_nationality').val(_this.find('.employee_nationality').text());
        $('#employee_bank_name_code').val(_this.find('.employee_bank_name_code').text());
        $('#employee_company_site').val(_this.find('.employee_company_site').text());
        $('#employee_account').val(_this.find('.employee_account').text());
        $('#employee_job_title').val(_this.find('.employee_job_title').text());
        $('#employee_bank_address').val(_this.find('.employee_bank_address').text());
        $('#employee_employee_id').val(_this.find('.employee_employee_id').text());

    });
</script>
{{-- delete model --}}
<script>
    $(document).on('click','.delete_project',function()
    {
        var _this = $(this).parents('tr');
        $('.e_id').val(_this.find('.id').text());
    });
</script>



<script>
    $("input:checkbox").on('click', function()
    {
        var $box = $(this);
        if ($box.is(":checked"))
        {
            var group = "input:checkbox[class='" + $box.attr("class") + "']";
            $(group).prop("checked", false);
            $box.prop("checked", true);
        }
        else
        {
            $box.prop("checked", false);
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.select2s-hidden-accessible').select2({
            closeOnSelect: false
        });
    });
</script>

@endsection

@endsection
