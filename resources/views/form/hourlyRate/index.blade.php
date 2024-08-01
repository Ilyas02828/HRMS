
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
                        <h3 class="page-title">Hourly Rate</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Hourly Rate</li>
                        </ul>
                    </div>
                    <div class="col-auto float-right ml-auto">
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_hourly_rate"><i class="fa fa-plus"></i> Add Hourly Rate</a>
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
                                    <th>Project</th>
                                    <th>Employee Type</th>
                                    <th>Hourly Rate</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hourly_rates as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td hidden class="project_id">{{ $items->projects->id }}</td>
                                    <td class="project_name">{{ $items->projects->name }}</td>
                                    <td class="employee_type">{{ $items->employee_type }}</td>
                                    <td class="hourly_rate">{{ $items->hourly_rate }}</td>
                                    <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                            <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item  edit_hourly_rate" href="#" data-toggle="modal" data-target="#edit_hourly_rate"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                            <a class="dropdown-item delete_hourly_rate" href="#" data-toggle="modal" data-target="#delete_hourly_rate"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

        <!-- Add hourly rate Modal -->
        <div id="add_hourly_rate" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Hourly Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/hourly-rate/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label class="col-form-label">Project</label>
                                <select class="select select2s-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project" name="project" required>
                                    <option value="">-- Select --</option>
                                    @foreach ($projects as $key=>$project )
                                        <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Employee Type <span class="text-danger">*</span></label>
                                <input class="form-control @error('employee_type') is-invalid @enderror" type="text" id="employee_type" name="employee_type">
                                @error('employee_type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Hourly Rate <span class="text-danger">*</span></label>
                                <input class="form-control @error('hourly_rate') is-invalid @enderror" type="text" id="hourly_rate" name="hourly_rate">
                                @error('hourly_rate')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Add hourly rate Modal -->

        <!-- Edit hourly rate Modal -->
        <div id="edit_hourly_rate" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Hourly Rate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('form/hourly-rate/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label class="col-form-label">Project</label>
                                <select class="select select2s-hidden-accessible project_edit" style="width: 100%;" tabindex="-1" aria-hidden="true" id="project_edit" name="project" required>
                                <option value="">-- Select --</option>
                                @foreach ($projects as $key=>$project )
                                    <option value="{{ $project->id }}">{{ $project->name }}</option>
                                    @endforeach
                                    </select>
                            </div>
                            <div class="form-group">
                                <label>Employee Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="employee_type_edit" name="employee_type" value="">
                            </div>
                            <div class="form-group">
                                <label>Employee Type <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="hourly_rate_edit" name="hourly_rate" value="">
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary submit-btn">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Edit hourly rate Modal -->

        <!-- Delete hourly rate Modal -->
        <div id="delete_hourly_rate" class="modal custom-modal fade" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="form-header">
                            <h3>Delete Hourly Rate</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('form/hourly-rate/delete') }}" method="POST">
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
        <!-- /Delete hourly rate Modal -->
    </div>

    <!-- /Page Wrapper -->
    @section('script')
    {{-- update js --}}
    <script>
        $(document).on('click','.edit_hourly_rate',function()
        {
            var project =$(".project_edit");
            $('option', project).remove();
            var _this = $(this).parents('tr');

            $('#e_id').val(_this.find('.id').text());
            var project_id_class = _this.find('.project_id').text();
            var project_name = _this.find('.project_name').text();
            $('#employee_type_edit').val(_this.find('.employee_type').text());
            $('#hourly_rate_edit').val(_this.find('.hourly_rate').text());

            $('<option/>', {
                'value': project_id_class,
                'text': project_name
            }).appendTo('.project_edit');
        });
    </script>
    {{-- delete model --}}
    <script>
        $(document).on('click','.delete_hourly_rate',function()
        {
            var _this = $(this).parents('tr');
            $('.e_id').val(_this.find('.id').text());
        });
    </script>
    @endsection
@endsection
