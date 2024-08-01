@extends('layouts.master')
@section('content')
    {{-- message --}}
    {!! Toastr::message() !!}
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Time Sheet Report</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                            <li class="breadcrumb-item active">Time Sheet Report</li>
                        </ul>

                        <div class="run_report_btn" style="float: right; font-weight: bolder"> Export in
                            <button class="btn btn-warning" onclick="ExportToExcel('xlsx')" >Excel</button>
                            <button onclick="ExportToCsv('csv');" class="btn btn-info">CSV</button>
                            <button onclick="printdiv('printDiv');" class="btn btn-success">Print</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

            <!-- Search Filter -->
            <form action="{{ route('timesheetreports') }}">
                @csrf
                <div class="row filter-row">

                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus select-focus">
                            <select class="select floating" name="employee_id">
                                <option value="">Select Employee</option>
                                @foreach ($employees as $key=>$employee )
                                    <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                @endforeach
                            </select>
                            <label class="focus-label">Employee </label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="datefrom" class="form-control floating datetimepicker" type="text">
                            </div>
                            <label class="focus-label">From</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="dateto" class="form-control floating datetimepicker" type="text">
                            </div>
                            <label class="focus-label">To</label>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-3">
                        {{--                    <a href="#" class="btn btn-success btn-block"> Search </a>--}}
                        <button type="sumit" class="btn btn-success btn-block"> Search</button>

                    </div>
                </div>
            </form>

            <!-- /Search Filter -->

            <!-- /Page Header -->
            {!! Toastr::message() !!}
            <div class="row" id="printDiv">
                <div class="col-md-12">
                    <div>
                        <table class="table table-striped custom-table mb-0 datatable">
                            <thead>
                            <tr style="font-weight: bolder;">
                                <th style="width: 30px;">#</th>
                                <th>Project Name</th>
                                <th>Employee Name</th>
                                <th>Punch In</th>
                                <th>Punch Out</th>
                                <th>Hours</th>
                                <th>Shift</th>
                                <th>Trade</th>
                                <th>Per hour</th>
                                <th>Total Pay</th>

                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i=1;
                                    $perhour ='';
                                    $totalpay ='';
                                    $sumTotalPay = 0;
                            @endphp
                            @foreach ($timesheet as $item )
                                <tr>
                                    <td>{{ $item->employee->id }}</td>
                                    <td hidden class="id">{{ $item->id }}</td>
                                    <td class="project_id"><a
                                            href="{{ route('projects/employees', $item->id) }}">{{ !empty($item->project->name) ? $item->project->name : '' }} </a>
                                    </td>
                                    <td class="employee_edit">{{ !empty($item->employee->name) ? $item->employee->name : '' }}</td>
                                    <td class="punchin">{{ \Carbon\Carbon::parse($item->punchin)->format('h:m A,  d/m/Y') }}</td>
                                    <td class="punchout">{{ \Carbon\Carbon::parse($item->punchout)->format('h:m A,  d/m/Y') }}</td>
                                    <td>{{ $item->today_hours }}</td>
                                    <td class="shift">{{ $item->shift }}</td>
                                    <td class="trade">{{ $item->trade }}</td>

                                @php
                                $monthsal = \App\Models\MonthlySalary::where('employee_id', $item->employee->id)
                                                ->orderBy('created_at', 'desc')->first();

                                if (!empty($monthsal)) {
                                    $perhour = $monthsal->per_hour_rate;
                                    $totalpay = $perhour * $item->today_hours;
                                    } else {
                                 $totalpay = 0;
                            }

                        $sumTotalPay += is_numeric($totalpay) ? $totalpay : 0;

                                    @endphp
                                    <td class="shift">{{ !empty($perhour) ? $perhour : ''  }}</td>
                                    <td class="trade">{{ $totalpay }}</td>

                                    <td class="text-right">
                                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                               aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                            <div class="dropdown-menu dropdown-menu-right">
                                                <a class="dropdown-item delete_punch" href="#" data-toggle="modal"
                                                   data-target="#delete_punch"><i class="fa fa-trash-o m-r-5"></i>
                                                    Delete</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                                <td colspan="8" class="text-right" style="font-weight: bold">Subtotal </td>
                                <td colspan="2" class="text-right" style="font-weight: bold; ">{{ $sumTotalPay }} </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
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

