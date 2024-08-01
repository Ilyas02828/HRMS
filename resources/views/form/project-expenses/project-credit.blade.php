
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
                        <h3 class="page-title">Project Expense</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Project Credit Expense </li>
                        </ul>
                        <div class="run_report_btn" style="float: right; font-weight: bolder"> Export in
                            <button class="btn btn-warning" onclick="ExportToExcel('xlsx')" >Excel</button>
                            <button onclick="ExportToCsv('csv');" class="btn btn-info">CSV</button>
                            <button onclick="printdiv('printDiv');" class="btn btn-success">Print</button>
                            <div class="col-auto float-right ml-auto">
                                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add Project Credit</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search Filter -->
            <form action="{{ route('projects/project-expense-credit/index') }}" method="GET">
                <div class="row filter-row">

                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus select-focus">
                            <select class="select2" style="width: 100%;" id="project_filter" name="project_filter" >
                                <option value=""> Select Project</option>
                                @foreach ($projects as $key=>$project )
                                    <option value="{{ $project->id }}" @if (old('project_filter') == $project->id) selected="selected" @endif>{{ $project->name }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Employee </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="month_filter" value="{{ old('month_filter') }}" class="form-control floating month-year" type="text">
                            </div>
                            <label class="focus-label">Month</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="date_from_filter" class="form-control floating datetimepicker" type="text">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="date_to_filter" class="form-control floating datetimepicker" type="text">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-2">
                        <div class="form-group form-focus select-focus">
                            <select class="select2" style="width: 100%;" id="status_filter" name="status_filter" >
                                <option value=""> Select Status</option>
                                <option value="1" @if (old('status_filter') == '1') selected="selected" @endif>Received</option>
                                <option value="0" @if (old('status_filter') == '0') selected="selected" @endif> Pending</option>
                            </select>
                            <label class="focus-label">Status </label>
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
                                    <th>Project</th>
                                    <th>Invoice</th>
                                    <th>Month</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($expenseCredits as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>

                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td hidden class="project_id">{{ $items->projects->id }}</td>
                                    <td hidden class="project_status_id">{{ $items->status }}</td>

                                    <td class="project_name">{{ $items->projects->name }} </td>
                                    <td class="invoice_number">{{ $items->invoice_number }}</td>
                                    <td class="month">{{ $items->month }}</td>
                                    <td class="date">{{ date('d-m-Y', strtotime($items->date)) }}</td>
                                    <td class="amount">{{ $items->amount }}</td>
                                    <td class="project_status_name">@if($items->status == 1) Received @elseif($items->status == 0) Pending @endif</td>
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item  edit_project" href="#" data-toggle="modal" data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delete_project" href="#" data-toggle="modal" data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
        <!-- /Page Content -->

        <!-- Add project Modal -->
        <div id="add_project" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Project Credit Expense</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects/project-expense-credit/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <select class="select2s-hidden-accessible" style="width: 100%;" id="project_id" name="project_id" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($projects as $key=>$project )
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Invoice Number <span class="text-danger">*</span></label>
                                <input class="form-control " type="text" id="invoice_number" name="invoice_number" placeholder="Invoice Number">
                            </div>
                            <div class="form-group">
                                <label>Month <span class="text-danger">*</span></label>
                                <input class="form-control month-year" type="text" id="month" name="month" placeholder="Invoice Month">
                            </div>
                            <div class="form-group">
                                <label>Invoice Date <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="date" name="date" placeholder="Invoice Date">
                            </div>
                            <div class="form-group">
                                <label>Amount  <span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="Invoice Amount">
                            </div>
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select2" style="width: 100%;" id="status" name="status">
                                    <option value="">-- Select --</option>
                                    <option value="1">Received</option>
                                    <option value="0">Pending</option>
                                </select>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add project Modal -->

        <!-- Edit project Modal -->
        <div id="edit_project" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Project Expense </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects/project-expense-credit/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <select class="select2s-hidden-accessible project_edit" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_id" name="project_id" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($projects as $key=>$project )
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Invoice Number <span class="text-danger">*</span></label>
                                <input class="form-control " type="text" id="edit_invoice_number" name="invoice_number" value="" placeholder="Invoice Number">
                            </div>
                            <div class="form-group">
                                <label>Month <span class="text-danger">*</span></label>
                                <input class="form-control month-year" type="text" id="edit_month" name="month" value="" placeholder="Invoice Month">
                            </div>
                            <div class="form-group">
                                <label>Invoice Date <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="edit_date" name="date" placeholder="Invoice Date">
                            </div>
                            <div class="form-group">
                                <label>Amount  <span class="text-danger">*</span></label>
                                <input type="number" name="amount" class="form-control" id="edit_amount" value="" placeholder="Invoice Amount">
                            </div>
                            <div class="form-group">
                                <label>Status <span class="text-danger">*</span></label>
                                <select class="select2s-hidden-accessible invoice_status_edit" style="width: 100%;"  id="invoice_status_edit" name="status">
                                    <option value="">-- Select --</option>
                                    <option value="1">Received</option>
                                    <option value="0">Pending</option>
                                </select>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit project Modal -->

        <!-- Delete project Modal -->
        <div class="modal custom-modal fade" id="delete_project" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Project Credit</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('projects/project-expense-credit/delete') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" class="e_id" value="">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn submit-btn">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="btn btn-primary cancel-btn">Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Delete project Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>

        $(function() {
            $('.month-year').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM'
            });
        });

        $(document).on('click','.edit_project',function()
        {

            var _this = $(this).parents('tr');

            $('#e_id').val(_this.find('.id').text());

            $('#project_edit').val(_this.find('.project_name').text());
            $('#edit_invoice_number').val(_this.find('.invoice_number').text());
            $('#edit_month').val(_this.find('.month').text());
            $('#edit_date').val(_this.find('.date').text());
            $('#edit_amount').val(_this.find('.amount').text());

            var project =$(".project_edit");
            $('option', project).remove();
            var project_id_class = _this.find('.project_id').text();
            var project_name = _this.find('.project_name').text();

            $('<option/>', {
                'value': project_id_class,
                'text': project_name
            }).appendTo('.project_edit');


            var invoice_status_edit = $(".invoice_status_edit");
            $('option', invoice_status_edit).remove();
            var project_status_id = _this.find('.project_status_id').text();
            var project_status_name = _this.find('.project_status_name').text();


            $('<option/>', {
                'value': project_status_id,
                'text': project_status_name
            }).appendTo('.invoice_status_edit');
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

    <script type="text/javascript">
        $(document).ready(function() {
            $(".select2").select2();
        });
    </script>

    @endsection
@endsection
