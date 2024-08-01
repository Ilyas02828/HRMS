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
                                                <div class="staff-id">Job : {{ $employees->job_title }}</div>
                                                <div class="staff-id">Company : {{ $employees->company_site }}</div>
                                                <div class="small doj text-muted">Nationality : {{$employees-> nationality}}</div>
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
                                                        <div class="title">Birthday:</div>
                                                        <div class="text">{{$employees->birth_date }}</div>
                                                        
                                                    </li>
                                                    <li>
                                                        <div class="title">Nationality:</div>
                                                        <div class="text">{{$employees->nationality}}</div>
                                                        
                                                    </li>
                                                    <li>
                                                        <div class="title">Gender:</div>
                                                        <div class="text">{{$employees->gender}}</div>
                                                        
                                                    </li>
                                                       
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="pro-edit"><a data-target="#add_employee" data-toggle="modal" class="edit-icon" href="#"><i class="fa fa-pencil"></i></a></div>
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
                                    <h3 class="card-title">Company Informations</h3>
                                        <ul class="personal-info">
                                            <li>
                                                <div class="title">Job Title</div>
                                                <div class="text">{{$employees->job_title}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Company Site</div>
                                                <div class="text">{{$employees->company_site}}</div>
                                            </li>
                                                                        <hr>

                        <h3 class="section-title"> Allownce Information</h3>
<li>
                                                <div class="title">Food Allownce</div>
                                                <div class="text">{{$employees->food_allownce}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Deduction Food Allownce</div>
                                                <div class="text">{{$employees->deduction_food_allownce}}</div>
                                            </li>
                                            <li>
                                                <div class="title">PPE Card Deduction</div>
                                                <div class="text">{{$employees->ppe_card_deduction}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Dress Allownce</div>
                                                <div class="text">{{$employees->dress_allownce}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Deduction Dress Allownce</div>
                                                <div class="text">{{$employees->deduction_dress_allownce}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Travel Allownce</div>
                                                <div class="text">{{$employees->travel_allownce}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Deduction Travel Allownce</div>
                                                <div class="text">{{$employees->deduction_travel_allownce}}</div>
                                            </li>

                                            <li>
                                                <div class="title">Visa Fee</div>
                                                <div class="text">{{$employees->visa_fee}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Deduction Visa Fee</div>
                                                <div class="text">{{$employees->deduction_visa_fee}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Visa Fee Remaining</div>
                                                <div class="text">{{$employees->visa_fee_remaining}}</div>
                                            </li>
                                            <li>
                                                <div class="title">Deduction Medical Expense</div>
                                                <div class="text">{{$employees->deduc_medical_expense}}</div>
                                            </li>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Working Details</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Total Working Days</div>
                                            <div class="text">{{$employees->total_working_days}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Total Absenties</div>
                                            <div class="text">{{$employees->total_absenties}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Normal Working Hours</div>
                                            <div class="text">{{$employees->normal_working_hours}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Over Time Hours</div>
                                            <div class="text">{{$employees->over_time_hours}}</div>
                                        </li>
                                    
                                        <li>
                                            <div class="title">Total Hours</div>
                                            <div class="text">{{$employees->total_hours}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Per Hour Rate</div>
                                            <div class="text">{{$employees->per_hour_rate}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Site Insentives </div>
                                            <div class="text">{{$employees->site_insentives}}</div>
                                        </li>
                                    </ul>
                                                                        <hr>

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
                    <div class="row">
                        <div class="col-md-12 d-flex">
                            <div class="card profile-box flex-fill">
                                <div class="card-body">
                                    <h3 class="card-title">Salary information</h3>
                                    <ul class="personal-info">
                                        <li>
                                            <div class="title">Previous Salary</div>
                                            <div class="text">{{$employees->previous_salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Total Salary</div>
                                            <div class="text">{{$employees->total_salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Total Salary OP</div>
                                            <div class="text">{{$employees->total_salary_op}}</div>
                                        </li>
                                        <li>
                                            <div class="title"> Salary</div>
                                            <div class="text">{{$employees->salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title">VAT 15 percent</div>
                                            <div class="text">{{$employees->vat_15_percent}}</div>
                                        </li>
                                        <li>
                                            <div class="title">VAT without 15 percent</div>
                                            <div class="text">{{$employees->vat_without_15_percent}}</div>
                                        </li>
                                        <li>
                                            <div class="title"> With VAT 15 percent</div>
                                            <div class="text">{{$employees->bank_address}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Advance Salary</div>
                                            <div class="text">{{$employees->advance_salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Remaining Salary</div>
                                            <div class="text">{{$employees->remaining_salary}}</div>
                                        </li>
                                        <li>
                                            <div class="title"> Salary Paid to</div>
                                            <div class="text">{{$employees->salary_paid_to}}</div>
                                        </li>
                                       
                                       <li>
                                            <div class="title">Paid Time</div>
                                            <div class="text">{{$employees->paid_time}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Paid Date</div>
                                            <div class="text">{{$employees->paid_date}}</div>
                                        </li>
                                        <li>
                                            <div class="title">Trade 1</div>
                                            <div class="text">{{$employees->trade_01}}</div>
                                        </li>
                                    </ul>

                                    
                                </div>
                            </div>
                        </div>
                      
                        
                </div>
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
                        <form action="{{ route('all/employee/updates') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Basic Information</h4>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">

                                    <label class="col-form-label">Full Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="name" name="name" placeholder="Employee Full Name" value="{{$employees->name}}">
                                    </div>
                                </div>
                         <input class="form-control" type="hidden" id="empid" name="empid" value="{{$employees->id}}">

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="Auto email" value="{{$employees->email}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Contact <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="contact" name="contact" placeholder="Contact Number" value="{{$employees->contact}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Nationality <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="nationality" name="nationality" placeholder="Nationality" value="{{$employees->nationality}}">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate" value="{{$employees->birth_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="select form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="gender" name="gender">
                                            <option selected value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Company Information</h4>
                                </div>

                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Job Title <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="job_title" name="job_title" placeholder="Job Title" value="{{$employees->job_title}}">
                                    </div>
                                </div>

                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Company / Site <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="company_site" name="company_site" placeholder="Company / Site" value="{{$employees->company_site}}">
                                    </div>
                                </div>
                            
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Working Details</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Working Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_working_days" name="total_working_days" placeholder="Total Working Days" value="{{$employees->total_working_days}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Absenties <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_absenties" name="total_absenties" placeholder="Total Absenties" value="{{$employees->total_absenties}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Normal Working Hours <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="normal_working_hours" name="normal_working_hours" placeholder="Normal Working Hours" value="{{$employees->normal_working_hours}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Over Time Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="over_time_hours" name="over_time_hours" placeholder="Over Time Hours" value="{{$employees->over_time_hours}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Total Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_hours" name="total_hours" placeholder="Total Hours" value="{{$employees->total_hours}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Per Hour Rate<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="per_hour_rate" name="per_hour_rate" placeholder="Per Hour Rate" value="{{$employees->per_hour_rate }}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Site Insentives<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="site_insentives" name="site_insentives" placeholder="Site Insentives" value="{{$employees->site_insentives}}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Allownce Information</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Food Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="food_allownce" name="food_allownce" placeholder="Food Allownce" value="{{$employees->food_allownce}}" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Food Allownce<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_food_allownce" name="deduction_food_allownce" placeholder="Deduction Food Allownce" value="{{$employees->deduction_food_allownce}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">PPE Card Deduction <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ppe_card_deduction" name="ppe_card_deduction" placeholder="PPE Card Deduction" value="{{$employees->ppe_card_deduction}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Dress Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="dress_allownce" name="dress_allownce" placeholder="Dress Allownce" value="{{$employees->dress_allownce}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Dress Allownce<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_dress_allownce" name="deduction_dress_allownce" placeholder="Deduction Dress Allownce" value="{{$employees->deduction_dress_allownce}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Travel Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="travel_allownce" name="travel_allownce" placeholder="Travel Allownce" value="{{$employees->travel_allownce}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Travel Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_travel_allownce" name="deduction_travel_allownce" placeholder="Deduction Travel Allownce" value="{{$employees->deduction_travel_allownce}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Visa Fee<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="visa_fee" name="visa_fee" placeholder="Visa Fee" value="{{$employees->visa_fee}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Visa Fee <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_visa_fee" name="deduction_visa_fee" placeholder="Deduction Visa Fee" value="{{$employees->deduction_visa_fee}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Visa Fee Remaining <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="visa_fee_remaining" name="visa_fee_remaining" placeholder="Visa Fee Remaining" value="{{$employees->visa_fee_remaining}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Medical Expense<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduc_medical_expense" name="deduc_medical_expense" placeholder="Deduction Medical Expense" value="{{$employees->deduc_medical_expense}}">
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
                                        <label class="col-form-label">Bank Name Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bank_name_code" name="bank_name_code" placeholder="Bank Name Code" value="{{$employees->bank_name_code}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Bank Address<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bank_address" name="bank_address" placeholder="Bank Address" value="{{$employees->bank_address}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Account<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="account" name="account" placeholder="Bank Account" value="{{$employees->account}}">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Salary Information</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">VAT 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_15_percent" name="vat_15_percent" placeholder="VAT 15 percent" value="{{$employees->vat_15_percent}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">VAT without 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_without_15_percent" name="vat_without_15_percent" placeholder="VAT without 15 percent" value="vat_without_15_percent">
                                    </div>
                                </div>
                               
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Advance Salary<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="advance_salary" name="advance_salary" placeholder=" Advance Salary" value="{{$employees->advance_salary}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary" value="{{$employees->salary}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Remaining Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="remaining_salary" name="remaining_salary" placeholder="Remaining  Salary" value="{{$employees->remaining_salary}}">
                                    </div>
                                </div>
                                                                <div class="col-sm-4">  
                                <div class="form-group">
                                        <label class="col-form-label">Previous Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="previous_salary" name="previous_salary" placeholder="Previous Salary" value="{{$employees->previous_salary}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary OP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary_op" name="total_salary_op" placeholder="Total Salary OP" value="{{$employees->total_salary_op}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary" name="total_salary" placeholder="Total Salary" value="{{$employees->total_salary}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Salary Paid To<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary_paid_to" name="salary_paid_to" placeholder="Salary Paid To" value="{{$employees->salary_paid_to}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Time <span class="text-danger">*</span></label>
                                        <input type="Time" class="form-control" id="paid_time" name="paid_time" placeholder="Paid Time" value="{{$employees->paid_time}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Date <span class="text-danger">*</span></label>
                                        <input type="Date" class="form-control" id="paid_date" name="paid_date" placeholder="Paid Date" value="{{$employees->paid_date}}">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Trade 01<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="trade_01" name="trade_01" placeholder="Trade 01" value="{{$employees->trade_01}}">
                                    </div>
                                </div>
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
                            
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="col-form-label">Email <span class="text-danger">*</span></label>
                                        <input class="form-control" type="email" id="email" name="email" placeholder="Auto email">
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
                                        <label class="col-form-label">Nationality <span class="text-danger">*</span></label>
                                        <input class="form-control" type="text" id="nationality" name="nationality" placeholder="Nationality">
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Birth Date</label>
                                        <div class="cal-icon">
                                            <input class="form-control datetimepicker" type="text" id="birthDate" name="birthDate">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="select form-control" style="width: 100%;" tabindex="-1" aria-hidden="true" id="gender" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Company Information</h4>
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
                                        <input type="text" class="form-control" id="company_site" name="company_site" placeholder="Company / Site">
                                    </div>
                                </div>
                            
                                                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Working Details</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Working Days <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_working_days" name="total_working_days" placeholder="Total Working Days" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Absenties <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_absenties" name="total_absenties" placeholder="Total Absenties">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Normal Working Hours <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="normal_working_hours" name="normal_working_hours" placeholder="Normal Working Hours" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Over Time Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="over_time_hours" name="over_time_hours" placeholder="Over Time Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Total Hours<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_hours" name="total_hours" placeholder="Total Hours">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Per Hour Rate<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="per_hour_rate" name="per_hour_rate" placeholder="Per Hour Rate">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Site Insentives<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="site_insentives" name="site_insentives" placeholder="Site Insentives">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Allownce Information</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Food Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="food_allownce" name="food_allownce" placeholder="Food Allownce" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Food Allownce<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_food_allownce" name="deduction_food_allownce" placeholder="Deduction Food Allownce">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">PPE Card Deduction <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="ppe_card_deduction" name="ppe_card_deduction" placeholder="PPE Card Deduction">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Dress Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="dress_allownce" name="dress_allownce" placeholder="Dress Allownce" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Dress Allownce<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_dress_allownce" name="deduction_dress_allownce" placeholder="Deduction Dress Allownce" >
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Travel Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="travel_allownce" name="travel_allownce" placeholder="Travel Allownce">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Travel Allownce <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_travel_allownce" name="deduction_travel_allownce" placeholder="Deduction Travel Allownce">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Visa Fee<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="visa_fee" name="visa_fee" placeholder="Visa Fee">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Deduction Visa Fee <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduction_visa_fee" name="deduction_visa_fee" placeholder="Deduction Visa Fee">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Visa Fee Remaining <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="visa_fee_remaining" name="visa_fee_remaining" placeholder="Visa Fee Remaining">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Deduction Medical Expense<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="deduc_medical_expense" name="deduc_medical_expense" placeholder="Deduction Medical Expense">
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
                                        <label class="col-form-label">Bank Name Code <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="bank_name_code" name="bank_name_code" placeholder="Bank Name Code">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
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
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Salary Information</h4>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">VAT 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_15_percent" name="vat_15_percent" placeholder="VAT 15 percent">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">VAT without 15 percent <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="vat_without_15_percent" name="vat_without_15_percent" placeholder="VAT without 15 percent">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="" name="" placeholder="">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Advance Salary<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="advance_salary" name="advance_salary" placeholder=" Advance Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary" name="salary" placeholder="Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Remaining Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="remaining_salary" name="remaining_salary" placeholder="Remaining  Salary">
                                    </div>
                                </div>
                                                                <div class="col-sm-4">  
                                <div class="form-group">
                                        <label class="col-form-label">Previous Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="previous_salary" name="previous_salary" placeholder="Previous Salary">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary OP <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary_op" name="total_salary_op" placeholder="Total Salary OP">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Total Salary <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="total_salary" name="total_salary" placeholder="Total Salary ">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Salary Paid To<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="salary_paid_to" name="salary_paid_to" placeholder="Salary Paid To">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Time <span class="text-danger">*</span></label>
                                        <input type="Time" class="form-control" id="paid_time" name="paid_time" placeholder="Paid Time">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label">Paid Date <span class="text-danger">*</span></label>
                                        <input type="Date" class="form-control" id="paid_date" name="paid_date" placeholder="Paid Date">
                                    </div>
                                </div>
                                <div class="col-sm-4">  
                                    <div class="form-group">
                                        <label class="col-form-label"> Trade 01<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="trade_01" name="trade_01" placeholder="Trade 01">
                                    </div>
                                </div>
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
       
            </div>
        </div>
        <!-- /Page Content -->
    </div>
@endsection