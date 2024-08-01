@extends('layouts.settings')
@section('content')
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div class="sidebar-menu">
                <ul>
                    <li><a href="{{ route('home') }}"><i class="la la-home"></i> <span>Back to Home</span></a></li>
                    <li class="menu-title">Settings</li>
                    <li class="active"><a href="{{ route('company/settings/page') }}"><i class="la la-building"></i><span>Company Settings</span></a></li>
                    <li><a href="localization.html"><i class="la la-clock-o"></i><span>Localization</span></a></li>
                    <li><a href="theme-settings.html"><i class="la la-photo"></i><span>Theme Settings</span></a></li>
                    <li><a href="{{ route('roles/permissions/page') }}"><i class="la la-key"></i><span>Roles & Permissions</span></a></li>
                    <li><a href="email-settings.html"><i class="la la-at"></i><span>Email Settings</span></a></li>
                    <li><a href="performance-setting.html"><i class="la la-chart-bar"></i><span>Performance Settings</span></a></li>
                    <li><a href="approval-setting.html"><i class="la la-thumbs-up"></i><span>Approval Settings</span></a></li>
                    <li><a href="invoice-settings.html"><i class="la la-pencil-square"></i><span>Invoice Settings</span></a></li>
                    <li><a href="salary-settings.html"><i class="la la-money"></i><span>Salary Settings</span></a></li>
                    <li><a href="notifications-settings.html"><i class="la la-globe"></i><span>Notifications</span></a></li>
                    <li><a href="{{ route('change/password') }}"><i class="la la-lock"></i><span>Change Password</span></a></li>
                    <li><a href="leave-type.html"><i class="la la-cogs"></i><span>Leave Type</span></a></li>
                    <li><a href="toxbox-setting.html"><i class="la la-comment"></i><span>ToxBox Settings</span></a></li>
                    <li><a href="cron-setting.html"><i class="la la-rocket"></i><span>Cron Settings</span></a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Sidebar -->
    
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <!-- Page Content -->
        <div class="content container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <!-- Page Header -->
                    <div class="page-header">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3 class="page-title">Company Settings</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /Page Header -->
                    <form>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Company Name <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" value="Soeng Souy">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Contact Person</label>
                                    <input class="form-control " value="Soeng Souy" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control " value="3864 Bld 110 PP, CA, 91403" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Country</label>
                                    <select class="form-control select">
                                        <option>KHMER</option>
                                        <option>USA</option>
                                        <option>United Kingdom</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>City</label>
                                    <input class="form-control" value="Phnom Penh" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>State/Province</label>
                                    <select class="form-control select">
                                        <option>Phnom Penh</option>
                                        <option>Pursat</option>
                                        <option>Kan dal</option>
                                        <option>Ta Keav</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <label>Postal Code</label>
                                    <input class="form-control" value="12000" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control" value="example@gmail.com" type="email">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control" value="855-978-7102" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile Number</label>
                                    <input class="form-control" value="855-635-5579" type="text">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax</label>
                                    <input class="form-control" value="818-978-7102" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Website Url</label>
                                    <input class="form-control" value="https://www.soengsouy.com" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary submit-btn">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /Page Content -->
    </div>
    <!-- /Page Wrapper -->
@endsection