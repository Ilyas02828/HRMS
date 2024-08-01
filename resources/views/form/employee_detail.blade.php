@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Profile</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Employee</a></li>
                            <li class="breadcrumb-item active">Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- message --}}
            {!! Toastr::message() !!}
            <!-- /Page Header -->
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#">
                                            <img alt="" src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}" alt="{{ $employees->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $employees->name }}</h3>
                                                <div class="staff-id">Employee  ID : {{ $employees->employee_id }}</div>
                                                <div class="staff-id">Job : {{ $employees->job_title }}</div>
                                                <div class="staff-id">Company : {{ $employees->company_site }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text">{{ $employees->contact}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">{{ $employees->email }}</div>
                                                </li>
                                                    <li>
                                                        <div class="title">Nationality:</div>
                                                        <div class="text">{{$employees->nationality}}</div>

                                                    </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="tab-content">
                <!-- Profile Info Tab -->
                <div id="emp_profile" class="pro-overview tab-pane fade show active">
                    <div class="row">
                    <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Iqama information</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Iqama  Number</div>
                                            <div class="text">{{$employees->ecoma_number}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Iqama  Type</div>
                                            <div class="text">{{$employees->ecoma_type}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Iqama  Expiry</div>
                                            <div class="text">{{$employees->ecoma_expiry}}</div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Bank information</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Bank name Code</div>
                                            <div class="text">{{$employees->bank_name_code}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Bank Address</div>
                                            <div class="text">{{$employees->bank_address}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Bank account No.</div>
                                            <div class="text">{{$employees->account}}</div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection
