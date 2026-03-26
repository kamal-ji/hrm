@php
    $logo = !empty(get('company_logo'))
        ? asset('storage/' . get('company_logo'))
        : asset('assets/backend/img/logo.svg');
@endphp

<div class="two-col-sidebar" id="two-col-sidebar">
    <div class="twocol-mini">

        <!-- Add Quick Action -->
        <div class="dropdown">
            <a class="btn btn-primary bg-gradient btn-sm btn-icon rounded-circle d-flex align-items-center justify-content-center" 
               data-bs-toggle="dropdown" 
               href="javascript:void(0);" 
               role="button"  
               data-bs-display="static" 
               data-bs-reference="parent">
                <i class="isax isax-add"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-start">
                <li>
                    <a href="{{ route('business.create') }}" class="dropdown-item d-flex align-items-center">
                        <i class="isax isax-user-add me-2"></i>Add New Business
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.create') }}" class="dropdown-item d-flex align-items-center">
                        <i class="isax isax-user-add me-2"></i>Add New Staff
                    </a>
                </li>
            </ul>
        </div>
        <!-- /Add Quick Action -->

        <ul class="menu-list">
            <li>
                <a href="" data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Settings">
                    <i class="isax isax-setting-25"></i>
                </a>
            </li>
            <li>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
                   data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Logout">
                    <i class="isax isax-login-15"></i>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="sidebar" id="sidebar-two">

        <!-- Start Logo -->
        <div class="sidebar-logo">
            <a href="{{ route('dashboard') }}" class="logo logo-normal">
                <img src="{{ $logo }}" alt="Logo" width="50">
            </a>
            <a href="{{ route('dashboard') }}" class="logo-small">
                <img src="{{ $logo }}" alt="Logo" width="50">
            </a>
            <a href="{{ route('dashboard') }}" class="dark-logo">
                <img src="{{ $logo }}" alt="Logo" width="50">
            </a>
            <a href="{{ route('dashboard') }}" class="dark-small">
                <img src="{{ $logo }}" alt="Logo" width="50">
            </a>
            
            <!-- Sidebar Hover Menu Toggle Button -->
            <a id="toggle_btn" href="javascript:void(0);">
                <i class="isax isax-menu-1"></i>
            </a>
        </div>
        <!-- End Logo -->
                
        <!-- Search -->
        <div class="sidebar-search">
            <div class="input-icon-end position-relative">
                <input type="text" class="form-control" placeholder="Search Members, Companies, Employees...">
                <span class="input-icon-addon">
                    <i class="isax isax-search-normal"></i>
                </span>
            </div>
        </div>
        <!-- /Search -->

        <!--- Sidenav Menu -->
        <div class="sidebar-inner" data-simplebar>
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <!-- Dashboard -->
                    <li class="menu-title"><span>Dashboard</span></li>
                    <li>
                        <ul>
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="isax isax-home-25"></i><span>Main Dashboard</span>
                                </a>
                            </li>
                           
                            <li>
                                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                    <i class="isax isax-chart-215"></i><span>Admin Dashboard</span>
                                </a>
                            </li>
                         
                        </ul>
                    </li>

                    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('business_owner'))
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-building-4"></i><span>Business</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('business.index') }}" class="">All Businesses</a></li>
                                    <li><a href="{{ route('business.create') }}" class="">Add New Business</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->hasRole('admin'))
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-briefcase"></i><span>Employee</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('employee.index') }}" class="">All Employees</a></li>
                                    <li><a href="{{ route('employee.create') }}" class="">Add New Employee</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif

                    @if(auth()->user()->hasRole('business_owner'))
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-user"></i><span>Staff</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('staff.index') }}" class="">All Staff</a></li>
                                    <li><a href="{{ route('staff.create') }}" class="">Add New Staff</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-user"></i><span>Departments</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('department.index') }}" class="">All Departments</a></li>
                                    <li><a href="{{ route('department.create') }}" class="">Add New Department</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-user"></i><span>Designation</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('designation.index') }}" class="">All Designation</a></li>
                                    <li><a href="{{ route('designation.create') }}" class="">Add New Designation</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-user"></i><span>Allowance</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('allowance.index') }}" class="">All Allowance</a></li>
                                    <li><a href="{{ route('allowance.create') }}" class="">Add New Allowance</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="">
                                    <i class="isax isax-user"></i><span>Deductions</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('deduction.index') }}" class="">All Deductions</a></li>
                                    <li><a href="{{ route('deduction.create') }}" class="">Add New Deduction</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    @endif

                    <!-- Members Management (Your Existing Functionality) -->
                    <li class="menu-title"><span>Members Management</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);" class="{{ request()->routeIs('members.*') ? 'active' : '' }}">
                                    <i class="isax isax-people"></i><span>Members</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="#" class="">Add New Member</a></li>
                                    <li><a href="#" class="">All Members</a></li>
                                    <li><a href="#" class="">Active Members</a></li>
                                    <li><a href="#" class="">Inactive Members</a></li>
                                    <li><a href="#" class="">New Registrations</a></li>
                                </ul>
                            </li>

                            <!-- Company Users (Members who are company admins) -->
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-profile-2user"></i><span>Company Users</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Company Users</a></li>
                                    <li><a href="">Add Company User</a></li>
                                    <li><a href="">User Permissions</a></li>
                                    <li><a href="">User Activity</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Employee Management (New HRM Feature) -->
                    <li class="menu-title"><span>Employee Management</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-category-2"></i><span>Departments</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Departments</a></li>
                                    <li><a href="">Add Department</a></li>
                                    <li><a href="">Department Hierarchy</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-briefcase"></i><span>Designations</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Designations</a></li>
                                    <li><a href="">Add Designation</a></li>
                                    <li><a href="">Salary Structure</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Attendance Management (New HRM Feature) -->
                    <li class="menu-title"><span>Attendance Management</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-calendar-tick"></i><span>Daily Attendance</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Mark Attendance</a></li>
                                    <li><a href="">Today's Attendance</a></li>
                                    <li><a href="">Monthly Attendance</a></li>
                                    <li><a href="">Attendance Summary</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-clock"></i><span>Shifts & Schedule</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Shifts</a></li>
                                    <li><a href="">Add Shift</a></li>
                                    <li><a href="">Assign Shifts</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-calendar-edit"></i><span>Leave Management</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Applications</a></li>
                                    <li><a href="">Apply Leave</a></li>
                                    <li><a href="">Pending Approvals</a></li>
                                    <li><a href="">Leave Balance</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-gift"></i><span>Holidays</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">All Holidays</a></li>
                                    <li><a href="">Add Holiday</a></li>
                                    <li><a href="">Holiday Calendar</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Payroll Management (New HRM Feature) -->
                    <li class="menu-title"><span>Payroll Management</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-money-add"></i><span>Salary Processing</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Process Payroll</a></li>
                                    <li><a href="">Pending Payroll</a></li>
                                    <li><a href="">Processed Payroll</a></li>
                                    <li><a href="">Payroll History</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-dollar-circle"></i><span>Salary Structure</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Salary Templates</a></li>
                                    <li><a href="">Salary Components</a></li>
                                    <li><a href="">Assign Salary</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-money-recive"></i><span>Payslips</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Generate Payslips</a></li>
                                    <li><a href="">All Payslips</a></li>
                                    <li><a href="">Email Payslips</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                    <!-- Reports & Analytics (Combined) -->
                    <li class="menu-title"><span>Reports & Analytics</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-chart-success5"></i><span>Member Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Member Growth</a></li>
                                    <li><a href="">Member Activity</a></li>
                                    <li><a href="">Member Performance</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-chart-215"></i><span>Attendance Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Daily Report</a></li>
                                    <li><a href="">Monthly Report</a></li>
                                    <li><a href="">Summary Report</a></li>
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-money-recive"></i><span>Payroll Reports</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">Payroll Summary</a></li>
                                    <li><a href="">Department Wise</a></li>
                                    <li><a href="">Monthly Payroll</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="">
                                    <i class="isax isax-document-download"></i><span>Export Reports</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- Settings & Configuration -->
                    <li class="menu-title"><span>Settings & Configuration</span></li>
                    <li>
                        <ul>
                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-setting-25"></i><span>Attendance Settings</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">General Settings</a></li>
                                    <li><a href="">Company Profile</a></li>
                                    <li><a href="">Attendance Settings</a></li>
                                    <li><a href="">Leave Settings</a></li>
                                    <li><a href="">Payroll Settings</a></li>

                                    <li><a href="{{ route('attendance-template.index') }}" class="">Attendance Template</a></li>
                                    <li><a href="{{ route('attendance-geofence.index') }}" class="">Geofence</a></li>
                                    <li><a href="{{ route('shift-template.index') }}" class="">Shift Template</a></li>
                                    <li><a href="{{ route('automation-rule.index') }}" class="">Automation Rule</a></li>
                                   
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-briefcase"></i><span>Business Settings</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="{{ route('holiday-template.index') }}" class="">Holiday policy</a></li>
                                    <li><a href="{{ route('leave-policy.index') }}">Leave Policy</a></li>
                                  
                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="javascript:void(0);">
                                    <i class="isax isax-shield-tick"></i><span>Security & Access</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <ul>
                                    <li><a href="">System Users</a></li>
                                    <li><a href="">Roles & Permissions</a></li>
                                    <li><a href="">Activity Logs</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                  
                
                </ul>

                <!-- Sidebar Footer -->
                <div class="sidebar-footer">
                    <div class="trial-item bg-white text-center border">
                        <div class="d-flex flex-column align-items-center">
                            <span class="text-dark fs-13">System Status</span>
                            <h6 class="fs-14 fw-semibold text-dark mb-2">Active</h6>
                            <p class="fs-12 text-muted mb-3">Total Members: 1,245</p>
                        </div>
                        <a href="javascript:void(0);" class="close-icon"><i class="fa-solid fa-x"></i></a>
                    </div>
                    <ul class="menu-list">
                        <li>
                            <a href="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Profile">
                                <i class="isax isax-profile-circle"></i>
                            </a>
                        </li>
                        <li>
                            <a href="" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Settings">
                                <i class="isax isax-setting-25"></i>
                            </a>
                        </li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                               data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Logout">
                                <i class="isax isax-login-15"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>