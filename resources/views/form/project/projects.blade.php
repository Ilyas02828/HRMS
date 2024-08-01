
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
                        <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add Project</a>
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
                                    <th>Project Name</th>
                                    <th>Project In-charge</th>
                                    <th>Start Date</th>
                                    <th>Contact</th>
                                    <th>Location</th>
                                    <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $key=>$items )
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td hidden class="id">{{ $items->id }}</td>
                                    <td class="project_name"><a href="{{ route('projects/employees', $items->id) }}" >{{ $items->name }} </a></td>
                                    <td class="project_manager">{{ $items->manager }}</td>
                                    <td class="project_date">{{ $items->start_date }}</td>
                                    <td class="project_contact">{{ $items->contact }}</td>
                                    <td class="project_address">{{ $items->address }}</td>
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
                        <h5 class="modal-title">Add Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects/save') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input class="form-control @error('name') is-invalid @enderror" type="text" id="name" name="name" placeholder="Project Name/Title">
                                @error('project')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Project In-charge <span class="text-danger">*</span></label>
                                <input class="form-control " type="text" id="manager" name="manager" placeholder="Project In-charge name">
                            </div>
                            <div class="form-group">
                                <label>Start Date <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="start_date" name="start_date">
                            </div>
                            <div class="form-group">
                                <label>In-charge Contact  <span class="text-danger">*</span></label>
                                <input type="text" name="contact" class="form-control" id="contact" placeholder="In-charge Contact number">
                            </div>
                            <div class="form-group">
                                <label>Location <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="address" name="address" placeholder="Project Location">
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
                        <h5 class="modal-title">Edit Project</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('projects/update') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" id="e_id" value="">
                            <div class="form-group">
                                <label>Project Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="project_edit" name="name" value="">
                            </div>
                            <div class="form-group">
                                <label>Project In-charge <span class="text-danger">*</span></label>
                                <input class="form-control " type="text" id="manager_edit" name="manager" placeholder="Project In-charge name">
                            </div>
                            <div class="form-group">
                                <label>Start Date <span class="text-danger">*</span></label>
                                <input class="form-control datetimepicker" type="text" id="start_date_edit" name="start_date">
                            </div>
                            <div class="form-group">
                                <label>Contact <span class="text-danger">*</span></label>
                                <input type="text" name="contact" class="form-control" id="contact_edit" placeholder="In-charge Contact number">
                            </div>
                            <div class="form-group">
                                <label>location <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" id="address_edit" name="address" placeholder="Project Location">
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
                            <h3>Delete Project</h3>
                            <p>Are you sure want to delete?</p>
                        </div>
                        <div class="modal-btn delete-action">
                            <form action="{{ route('projects/delete') }}" method="POST">
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
        $(document).on('click','.edit_project',function()
        {
            var _this = $(this).parents('tr');
            $('#e_id').val(_this.find('.id').text());
            $('#project_edit').val(_this.find('.project_name').text());
            $('#manager_edit').val(_this.find('.project_manager').text());
            $('#start_date_edit').val(_this.find('.project_date').text());
            $('#contact_edit').val(_this.find('.project_contact').text());
            $('#address_edit').val(_this.find('.project_address').text());
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
    @endsection
@endsection
