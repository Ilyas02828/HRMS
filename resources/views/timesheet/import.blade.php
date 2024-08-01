
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
                        <h3 class="page-title">Import Time Sheet</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Time Sheet</li>
                        </ul>
                    </div>
                 

                </div>

            </div>
        <form class="user_import_template py-5" method="POST" action="{{route('importcsv')}}" enctype="multipart/form-data">
            @csrf
            <div class="text-center emp-import-step">
                <h2 class="heading-title" style="text-align: center;"><u>Import multiple employees in 3 easy steps.</u></h2>
            </div>
            <div class="row mt-4 g-0 justify-content-evenly">
                <div class="col-lg-4 user_import_template px-2 py-3 d-flex flex-column align-items-center">
                    <h2 class="import_number mb-0">1</h2>
                    <p class="mt-4 mb-0">Download the user</p>
                    <p class="mb-0">import template</p>
                    <a  href="{{ url('download_template') }}" class="btn btn-info">Download</a>
                </div>
                <div class="col-lg-4 mt-4 mt-lg-0 user_import_template px-2 py-3 d-flex flex-column align-items-center ">
                    <h2 class="import_number mb-0">2</h2>
                    <p class="mt-3 mb-0">Fill out the user</p>
                    <p class="mb-0">import template</p>
                </div>
                @csrf
                <div class="col-lg-4 mt-4 mt-lg-0 user_import_template px-2 py-3 d-flex flex-column align-items-center">
                    <h2 class="import_number mb-0">3</h2>
                    <p class="mt-4 mb-0">Upload the completed </p>
                    <p class="mb-0">user import template</p>
                    <label for="file-upload" class="file-upload-label mt-4 btn text-white" style="background-color:#92c622">
                        <input id="file-upload" type="file" name="csv" required style="display: none;">
                        Choose File
                    </label>
                </div>
            </div>
            <div class="px-8 py-6 d-flex flex-column align-items-center">
                <button style="float:right; font-weight: bolder;" type="submit" id="submit" name="submitimport"
                    class="btn btn-success "><i class="fa fa-upload"></i> Upload</button>
            </div>
        </form>

</div></div>
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
