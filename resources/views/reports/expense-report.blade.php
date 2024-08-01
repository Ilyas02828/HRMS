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
                            <li class="breadcrumb-item active">Project Expense</li>
                        </ul>
                    </div>

                    <div class="run_report_btn" style="float: right; font-weight: bolder"> Export in
                        <button class="btn btn-warning" onclick="ExportToExcel('xlsx')" >Excel</button>
                        <button onclick="ExportToCsv('csv');" class="btn btn-info">CSV</button>
                        <button onclick="printdiv('printDiv');" class="btn btn-success">Print</button>
                    </div>
                </div>
            </div>
            <!-- Search Filter -->
            <form action="{{ route('expense/project-expense/index') }}" method="GET">
                <div class="row filter-row">
                    <div class="col-sm-6 col-md-3">
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
                    <div class="col-sm-6 col-md-3">
                        <div class="form-group form-focus">
                            <div class="cal-icon">
                                <input name="month_filter" class="form-control floating month-year" type="text">
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
                        <button type="submit" class="btn btn-success btn-block"> Search</button>
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
                                <th>Project</th>
                                <th>Month</th>
                                <th>Total Credits</th>
                                <th>Paid Credits</th>
                                <th>Unpaid Credits</th>
                                <th>Total Debits</th>
                                <th class="text-right">Action</th>
                            </tr>
                            </thead>
                            @if(!empty($project)  ||  !empty($month)  || !empty($sum_credit) || !empty($paid_credit) || !empty($unpaid_credit) )
                            <tbody>
                                <tr>
                                    <td>{{ $project->name ?? ''}} </td>
                                    <td>{{ $month ?? '' }} </td>
                                    <td>{{ $sum_credit ?? '' }}</td>
                                    <td>{{ $paid_credit ?? ''}}</td>
                                    <td>{{ $unpaid_credit ?? '' }}</td>
                                    <td>{{ $sum_debit ?? ''}}</td>
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
                            </tbody>
                                @endif
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @section('script')
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

        <script>
        $(function() {
            $('.month-year').datetimepicker({
                viewMode: 'months',
                format: 'YYYY-MM'
            });
        });
    </script>
@endsection
@endsection
