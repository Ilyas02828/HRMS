@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Salary Details</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Salary</a></li>
                            <li class="breadcrumb-item active">Salary</li>
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
                                            <img alt="" src="{{ URL::to('/assets/images/'.Auth::user()->avatar) }}"
                                                 alt="{{  $Salary->employee->name }}">
                                        </a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 mb-0">{{ $Salary->employee->name }}</h3>
                                                <div class="staff-id">Employee ID
                                                    : {{ $Salary->employee->employee_id }}</div>
                                                <div class="staff-id">Job : {{ $Salary->employee->job_title }}</div>
                                                <div class="staff-id">Company
                                                    : {{ $Salary->employee->company_site }}</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <div class="title">Phone:</div>
                                                    <div class="text">{{ $Salary->employee->contact}}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Email:</div>
                                                    <div class="text">{{ $Salary->employee->email }}</div>
                                                </li>
                                                <li>
                                                    <div class="title">Nationality:</div>
                                                    <div class="text">{{ $Salary->employee->nationality}}</div>

                                                </li>
                                                <li>
                                                    <div class="title">Project:</div>
                                                    <div class="text">{{ $Salary->project->name}}</div>

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
                                    <h3  class="card-title"> <u> Salary Information </u></h3>

                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Salary Month</div>
                                            <div class="text">{{$Salary->month}}</div>
                                        </li>

                                        <li>
                                            <div class="title">Project</div>
                                            <div class="text">{{$Salary->project->name}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Employee Type</div>
                                            <div class="text">{{$Salary->employee_type->employee_type}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Month Days</div>
                                            <div class="text">{{$Salary->total_month_days}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Absenties</div>
                                            <div class="text">{{$Salary->total_absenties}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Holidays</div>
                                            <div class="text">{{$Salary->total_holidays}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Working Days</div>
                                            <div class="text">{{$Salary->total_working_days}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Normal Working Hours</div>
                                            <div class="text">{{$Salary->normal_working_hours}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Over Time Hours</div>
                                            <div class="text">{{$Salary->over_time_hours}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Total Working Hours</div>
                                            <div class="text">{{$Salary->total_hours}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Per Hour Rate</div>
                                            <div class="text">{{$Salary->employee_type->hourly_rate}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Vat %</div>
                                            <div class="text">{{$Salary->vat_15_percent}}</div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3  class="card-title"> <u>  Allowances Information </u></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Site Incentives </div>
                                            <div class="text">{{$Salary->site_insentives}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Food</div>
                                            <div class="text">{{$Salary->food_allownce}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Travel</div>
                                            <div class="text">{{$Salary->travel_allownce}}</div>
                                        </li>
                                        <li>
                                            <div class="title">PPE & Dress</div>
                                            <div class="text">{{$Salary->dress_ppe_card}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Medical</div>
                                            <div class="text">{{$Salary->medical_allowance}}</div>
                                        </li>
                                    </ul>

                                    <h3  class="card-title"> <u>  Deductions Information </u></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Food Deduction</div>
                                            <div class="text">{{$Salary->deduction_food_allownce}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Travel Deduction</div>
                                            <div class="text">{{$Salary->deduction_travel_allownce}}</div>
                                        </li>
                                        <li>
                                            <div class="title">PPE & Dress Deduction</div>
                                            <div class="text">{{$Salary->ppe_card_deduction}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Medical Deduction </div>
                                            <div class="text">{{$Salary->deduc_medical_expense}}</div>
                                        </li>
                                    </ul>
                                    <br>
                                    <div class="table mt-5">
                                        <h3>   Visa Total :  {{$Salary->employee->visa->first()->visa_fee}}</h3>
                                        <table class="table table-responsive custom-table">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px;">#</th>
                                                <th>Deduction</th>
                                                <th>Remaining </th>
                                                <th>Date </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=1; @endphp
                                            @foreach ($Salary->employee->visa as $visa )
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $visa->visa_deduction }}</td>
                                                    <td>{{ $visa->visa_remaining }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($visa->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3  class="card-title"> <u>  Advance Salary  </u></h3>
                                    <div class="table">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px;">#</th>
                                                <th>Advance</th>
                                                <th>Deduction</th>
                                                <th>Remaining </th>
                                                <th>Date </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=1;
                                            $advances = \App\Models\AdvanceSalary::where('employee_id',$Salary->employee_id)
                                            ->where('project_id',$Salary->project_id)->get();
                                            @endphp
                                            @foreach ($advances as $advance )
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $advance->advance_salary }}</td>
                                                    <td>{{ $advance->deduct_advance_salary }}</td>
                                                    <td>{{ $advance->advance_salary_remaining  }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($advance->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3  class="card-title"> <u>  Previous Salary  </u></h3>
                                    <div class="table">
                                        <table class="table table-responsive">
                                            <thead>
                                            <tr>
                                                <th style="width: 30px;">#</th>
                                                <th>Previous</th>
                                                <th>Deduction</th>
                                                <th>Remaining </th>
                                                <th>Date </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @php $i=1;
                                            $previous = \App\Models\PreviousSalary::where('employee_id',$Salary->employee_id)
                                            ->where('project_id',$Salary->project_id)->get();
                                            @endphp
                                            @foreach ($previous as $pre )
                                                <tr>
                                                    <td>{{ $i++ }}</td>
                                                    <td>{{ $pre->previous_salary }}</td>
                                                    <td>{{ $pre->deduct_previous_salary }}</td>
                                                    <td>{{ $pre->previous_salary_remaining }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($pre->created_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3  class="card-title"> <u> Salary Information </u></h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Total Salary OP</div>
                                            <div class="text">{{$Salary->total_salary_op ?? ''}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Total Salary</div>
                                            <div class="text">{{$Salary->salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Salary Paid To</div>
                                            <div class="text">{{$Salary->salary_paid_to}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Paid Time</div>
                                            <div class="text">{{$Salary->paid_time}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Paid Date</div>
                                            <div class="text">{{$Salary->paid_date}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Trade</div>
                                            <div class="text">{{$Salary->trade_01}}</div>
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
