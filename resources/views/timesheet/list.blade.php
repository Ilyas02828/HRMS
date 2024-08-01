
@extends('layouts.master')
@section('content')
   
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row align-item-center">
                    <div class="col">
                        <h3 class="page-title">Time Sheet</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Time Sheet</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Time Sheet</a>
                    </div>
                                  <div class="create-emp-btn mt-4 mt-lg-0">
                <a href="{{ url('punchin/import') }}" class="btn btn-info">
                     Import
                    Employees
                </a>
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
                                <tr style="font-weight: bolder;">
                                    <th style="width: 30px;">#</th>
                                    <th>Project Name</th>
                                    <th>Employee Name</th>
                                    <th>Punch In</th>
                                    <th>Punch Out</th>
                                    <th>Hours</th>
                                    <th>Shift</th>
                                    <th>Trade</th>
                           
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i=1; @endphp
                                @foreach ($timesheet as $item )
                                <tr>
                        <td>{{ $i++ }}</td>
                        <td hidden class="id">{{ $item->id }}</td>
                        <td class="project_id"><a href="{{ route('projects/employees', $item->id) }}" >{{ !empty($item->project->name) ? $item->project->name : '' }} </a></td>
                        <td class="employee_edit">{{ !empty($item->employee->name) ? $item->employee->name : '' }}</td>
                        <td class="punchin">{{ \Carbon\Carbon::parse($item->punchin)->format('h:m A,  d/m/Y') }}</td>
                        <td class="punchout">{{ \Carbon\Carbon::parse($item->punchout)->format('h:m A,  d/m/Y') }}</td>
                        <td >{{ $item->today_hours }}</td>
                        <td class="shift">{{ $item->shift }}</td>
                        <td class="trade">{{ $item->trade }}</td>
                        <td class="text-right">
                        <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item delete_punch" href="#" data-toggle="modal" data-target="#delete_punch"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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
                        <h5 class="modal-title"><b> Create Punch In </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('punchin/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <select class="form-control"  style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_id" name="project_id" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($projects as $key=>$project )
                                                <option value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                            </div>


                            <div class="form-group">
                                <label>Employee Name <span class="text-danger">*</span></label>
                                 <select class="form-control"  style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_id" name="employee_id" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($employees as $key=>$employee )
                                                <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                            </div>

              <div class="form-group">
                                <label>Punch In <span class="text-danger">*</span></label>
            <input type="datetime-local" name="punchin" class="form-control"
                                id="dateInput" required />
                            </div>

    <div class="form-group">
                                <label>Punch Out <span class="text-danger">*</span></label>
                             <input type="datetime-local" name="punchout" class="form-control"
                                id="dateInput" required />
                            </div>

                            <div class="form-group">
                                <label>Shift <span class="text-danger">*</span></label>
                                     <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_id" name="shift" required>
                                            <option selected>Day</option>
                                                <option>Night</option>
                                        </select>
                            </div>

                            <div class="form-group">
                                <label>Trade <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="trade" name="trade" placeholder="Employee Trade" required>
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
       <div id="edit_punch" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><b> Edit Punch In </b></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('punchin/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <select class="form-control"  style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_select" name="project_id" required>
                                            @foreach ($projects as $key=>$project )
                                                <option id="project_edit" selected value="{{ $project->id }}">{{ $project->name }}</option>
                                            @endforeach
                                        </select>
                            </div>


                            <div class="form-group">
                                <label>Employee Name <span class="text-danger">*</span></label>
                                 <select class="form-control"  style="width: 100%;" tabindex="-1" aria-hidden="true" id="employee_edit" name="employee_id" required>
                                            <option value="">-- Select --</option>
                                            @foreach ($employees as $key=>$employee )
                                                <option value="{{ $employee->id}}">{{ $employee->name }}</option>
                                            @endforeach
                                        </select>
                            </div>

              <div class="form-group">
                                <label>Punch In <span class="text-danger">*</span></label>
            <input type="datetime-local" name="punchin" class="form-control"
                                id="punchin_edit" required />
                            </div>

    <div class="form-group">
                                <label>Punch Out <span class="text-danger">*</span></label>
                             <input type="datetime-local" name="punchout" class="form-control"
                                id="punchout_edit" required />
                            </div>

                            <div class="form-group">
                                <label>Shift <span class="text-danger">*</span></label>
                                     <select class="form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="shift_edit" name="shift" required>
                                            <option selected>Day</option>
                                                <option>Night</option>
                                        </select>
                            </div>

                            <div class="form-group">
                                <label>Trade <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" id="trade_edit" name="trade" placeholder="Employee Trade" required>
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
        <div class="modal custom-modal fade" id="delete_punch" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Punch Details</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('punch/delete') }}" method="POST">
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
    <script>
        $(document).on('click', '.edit_punch', function() {
    var _this = $(this).parents('tr');
    $('#e_id').val(_this.find('.id').text());
    $('#project_edit').val(_this.find('.project_id a').text()); // Assuming you want the text of the anchor tag
    // $('#punchin_edit').val(_this.find('.punchin').text());
    $('#punchout_edit').val(_this.find('.punchout').text()); // Assuming you want the text of the punchout column
    $('#employee_edit').val(_this.find('.employee_id').text());
    $('#shift_edit').val(_this.find('.shift').text()); // Assuming you have a class for the shift column
    $('#trade_edit').val(_this.find('.trade').text()); // Assuming you have a class for the trade column

       var punchinDate = new Date(punchinText);

    punchinDate.setMinutes(punchinDate.getMinutes() - punchinDate.getTimezoneOffset());
    var formattedDateTime = punchinDate.toISOString().slice(0, 16);
    $('#punchin_edit').val(formattedDateTime);
});

    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_punch',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
