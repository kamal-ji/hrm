

<?php $__env->startSection('content'); ?>

<!-- Start Content -->
<div class="content">

    <!-- Start Breadcrumb -->
    <div class="d-flex d-block align-items-center justify-content-between flex-wrap gap-3 mb-3">
        <div>
            <h6>HR & Payroll Dashboard</h6>
        </div>
        <div class="d-flex my-xl-auto right-content align-items-center flex-wrap gap-2">
            <div id="reportrange" class="reportrange-picker d-flex align-items-center">
                <i class="isax isax-calendar text-gray-5 fs-14 me-1"></i><span class="reportrange-picker-field">16 Apr 2024 - 16 Apr 2024</span>
            </div>
            <div class="dropdown">
                <a class="btn btn-primary d-flex align-items-center justify-content-center dropdown-toggle"
                    data-bs-toggle="dropdown" href="javascript:void(0);" role="button">
                    Quick Actions
                </a>
                <ul class="dropdown-menu dropdown-menu-start">
                    <li>
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="isax isax-user-tick me-2"></i>Mark Attendance
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="isax isax-money-add me-2"></i>Process Payroll
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="isax isax-document-text me-2"></i>Generate Payslip
                        </a>
                    </li>
                    <li>
                        <a href="#" class="dropdown-item d-flex align-items-center">
                            <i class="isax isax-calendar-edit me-2"></i>Approve Leave
                        </a>
                    </li>
                </ul>
            </div>
            <div class="dropdown">
                <a href="javascript:void(0);" class="btn btn-outline-white d-inline-flex align-items-center"
                    data-bs-toggle="dropdown">
                    <i class="isax isax-export-1 me-1"></i>Reports
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="#">Attendance Report</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Payroll Report</a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="#">Leave Report</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- End Breadcrumb -->

    <div class="bg-primary rounded welcome-wrap position-relative mb-3">
        <!-- start row -->
        <div class="row">
            <div class="col-lg-8 col-md-9 col-sm-7">
                <div>
                    <?php
                    $hour = date("H");
                    if ($hour >= 5 && $hour < 12) { $wish="Good morning!" ; } elseif ($hour>= 12 && $hour < 17) {
                            $wish="Good afternoon!" ; } elseif ($hour>= 17 && $hour < 21) { $wish="Good evening!" ; }
                                else { $wish="Good night!" ; } ?> <h5 class="text-white mb-1"><?php echo e($wish); ?>, Admin</h5>
                                <p class="text-white mb-3">System Status: <span class="badge bg-success">Active</span></p>
                                <div class="d-flex align-items-center flex-wrap gap-3">
                                    <p class="d-flex align-items-center fs-13 text-white mb-0">
                                        <i class="isax isax-calendar5 me-1"></i>
                                        <?php echo e(now()->format('l, d M Y')); ?>

                                    </p>
                                    <p class="d-flex align-items-center fs-13 text-white mb-0">
                                        <i class="isax isax-people me-1"></i>
                                        Total Employees: 350
                                    </p>
                                    <p class="d-flex align-items-center fs-13 text-white mb-0">
                                        <i class="isax isax-profile-tick me-1"></i>
                                        Present Today: 312
                                    </p>
                                    <p class="d-flex align-items-center fs-13 text-white mb-0">
                                        <i class="isax isax-money-send me-1"></i>
                                        Pending Payroll: $45,200
                                    </p>
                                </div>
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->

        <div class="position-absolute end-0 top-50 translate-middle-y p-2 d-none d-sm-block">
            <img src="<?php echo e(asset('assets/backend/img/icons/attendance.svg')); ?>" alt="img">
        </div>
    </div>

    <!-- start row -->
    <div class="row">
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="d-flex align-items-center mb-1"><i
                                class="isax isax-people text-default me-2"></i>Employee Overview</h6>
                    </div>
                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-primary-subtle text-primary flex-shrink-0 me-2">
                                    <i class="isax isax-profile-2user fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Total Employees</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">350</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-success-subtle text-success-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-user-add fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">New Hires (MTD)</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">12</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-warning-subtle text-warning-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-briefcase fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Active Employees</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">338</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-info-subtle text-info-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-category fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Departments</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">8</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="d-flex align-items-center mb-1"><i
                                class="isax isax-chart-215 text-default me-2"></i>Salary Overview</h6>
                    </div>
                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-primary-subtle text-primary flex-shrink-0 me-2">
                                    <i class="isax isax-dollar-circle fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Total Payroll (MTD)</p>
                                    <h6 class="fs-16 fw-semibold mb-0">$245,680</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-success-subtle text-success-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-money-add fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Paid Salary</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">$200,480</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-warning-subtle text-warning-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-money-tick fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 mb-0">Pending Salary</p>
                                    <h6 class="fs-16 fw-semibold text-truncate">$45,200</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-info-subtle text-info-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-wallet-3 fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Monthly Budget</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">$280,000</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="d-flex align-items-center mb-1"><i
                                class="isax isax-calendar-2 text-default me-2"></i>Attendance Summary</h6>
                    </div>
                    <div class="row g-4">
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-primary-subtle text-primary flex-shrink-0 me-2">
                                    <i class="isax isax-profile-tick fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Present Today</p>
                                    <h6 class="fs-16 fw-semibold mb-0">312</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-danger-subtle text-danger-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-close-circle fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Absent Today</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">18</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-warning-subtle text-warning-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-calendar-tick fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">On Leave</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">20</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="d-flex align-items-center me-2">
                                <span
                                    class="avatar avatar-44 avatar-rounded bg-info-subtle text-info-emphasis flex-shrink-0 me-2">
                                    <i class="isax isax-clock fs-20"></i>
                                </span>
                                <div>
                                    <p class="mb-1 text-truncate">Overtime (Today)</p>
                                    <h6 class="fs-16 fw-semibold mb-0 text-truncate">24 hrs</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- start row -->
    <div class="row">
        <div class="col-md-4 d-flex flex-column">
            <div class="card overflow-hidden z-1 flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between border-bottom mb-2 pb-2">
                        <div>
                            <p class="mb-1">Today's Attendance</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs-16 fw-semibold me-2">312/350</h6>
                                <span class="badge badge-sm badge-soft-success">89%<i
                                        class="isax isax-arrow-up-15 ms-1"></i></span>
                            </div>
                        </div>
                        <span class="avatar avatar-lg bg-light text-dark avatar-rounded">
                            <i class="isax isax-profile-tick fs-16"></i>
                        </span>
                    </div>
                    <a href="#" class="fw-medium text-decoration-underline">View Attendance Log</a>
                </div>
                <div class="position-absolute end-0 bottom-0 z-n1">
                    <img src="<?php echo e(asset('assets/backend/img/bg/card-bg-01.svg')); ?>" alt="img">
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column">
            <div class="card overflow-hidden z-1 flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between border-bottom mb-2 pb-2">
                        <div>
                            <p class="mb-1">Pending Leave Requests</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs-16 fw-semibold me-2">15</h6>
                                <span class="badge badge-sm badge-soft-warning">+3 today</span>
                            </div>
                        </div>
                        <span class="avatar avatar-lg bg-light text-dark avatar-rounded">
                            <i class="isax isax-calendar-edit fs-16"></i>
                        </span>
                    </div>
                    <a href="#" class="fw-medium text-decoration-underline">Manage Leave</a>
                </div>
                <div class="position-absolute end-0 bottom-0 z-n1">
                    <img src="<?php echo e(asset('assets/backend/img/bg/card-bg-02.svg')); ?>" alt="img">
                </div>
            </div>
        </div>
        <div class="col-md-4 d-flex flex-column">
            <div class="card overflow-hidden z-1 flex-fill">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between border-bottom mb-2 pb-2">
                        <div>
                            <p class="mb-1">Monthly Payroll</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs-16 fw-semibold me-2">$245,680</h6>
                                <span class="badge badge-sm badge-soft-success">+5.2%<i
                                        class="isax isax-arrow-up-15 ms-1"></i></span>
                            </div>
                        </div>
                        <span class="avatar avatar-lg bg-light text-dark avatar-rounded">
                            <i class="isax isax-money-add fs-16"></i>
                        </span>
                    </div>
                    <a href="#" class="fw-medium text-decoration-underline">Run Payroll</a>
                </div>
                <div class="position-absolute end-0 bottom-0 z-n1">
                    <img src="<?php echo e(asset('assets/backend/img/bg/card-bg-03.svg')); ?>" alt="img">
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- start row -->
    <div class="row">
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body pb-0">
                    <div class="mb-3">
                        <h6 class="mb-1">Salary Analytics</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                        <div>
                            <p class="mb-1">Total Payroll (MTD)</p>
                            <div class="d-flex align-items-center">
                                <h6 class="fs-16 fw-semibold me-2">$245,680</h6>
                                <span class="badge badge-sm badge-soft-success">+8%<i
                                        class="isax isax-arrow-up-15 ms-1"></i></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <p class="fs-13 text-dark d-flex align-items-center mb-0"><i
                                    class="fa-solid fa-circle text-primary-transparent fs-12 me-1"></i>Gross Salary </p>
                            <p class="fs-13 text-dark d-flex align-items-center mb-0"><i
                                    class="fa-solid fa-circle text-primary fs-12 me-1"></i>Net Paid</p>
                        </div>
                    </div>
                    <div id="salary_chart"></div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="mb-1">Top Earners</h6>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-nowrap table-borderless custom-table">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-lg rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-01.jpg')); ?>"
                                                    class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-1">
                                                    <a href="#">John Smith</a>
                                                </h6>
                                                <p class="fs-13">Software Architect</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">Monthly Salary</p>
                                        <h6 class="fs-14 fw-semibold">$12,500</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <span class="badge bg-warning">
                                                Senior
                                            </span>
                                            <a href="#" 
                                               class="btn btn-icon btn-sm btn-light" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-title="View Details">
                                                <i class="isax isax-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-lg rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-02.jpg')); ?>"
                                                    class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-1">
                                                    <a href="#">Emily Clark</a>
                                                </h6>
                                                <p class="fs-13">Product Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">Monthly Salary</p>
                                        <h6 class="fs-14 fw-semibold">$9,850</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <span class="badge bg-success">
                                                Lead
                                            </span>
                                            <a href="#" 
                                               class="btn btn-icon btn-sm btn-light" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-title="View Details">
                                                <i class="isax isax-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-lg rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-03.jpg')); ?>"
                                                    class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-1">
                                                    <a href="#">Michael Brown</a>
                                                </h6>
                                                <p class="fs-13">Senior Developer</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">Monthly Salary</p>
                                        <h6 class="fs-14 fw-semibold">$8,250</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <span class="badge bg-info">
                                                Mid-Level
                                            </span>
                                            <a href="#" 
                                               class="btn btn-icon btn-sm btn-light" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-title="View Details">
                                                <i class="isax isax-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-lg rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-04.jpg')); ?>"
                                                    class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-1">
                                                    <a href="#">Sarah Johnson</a>
                                                </h6>
                                                <p class="fs-13">HR Manager</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-1">Monthly Salary</p>
                                        <h6 class="fs-14 fw-semibold">$7,150</h6>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-end gap-2">
                                            <span class="badge bg-secondary">
                                                Manager
                                            </span>
                                            <a href="#" 
                                               class="btn btn-icon btn-sm btn-light" 
                                               data-bs-toggle="tooltip" 
                                               data-bs-title="View Details">
                                                <i class="isax isax-eye"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="#" class="btn btn-light btn-lg w-100 text-decoration-underline mt-3">All Top Earners</a>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- start row -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap mb-3">
                        <h6 class="mb-1">Recent Salary Payments</h6>
                        <a href="#" class="btn btn-primary mb-1">View All Payments</a>
                    </div>
                    <div class="table-responsive no-filter no-pagination">
                        <table class="table table-nowrap border mb-0">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Employee</th>
                                    <th>Department</th>
                                    <th>Gross Amount</th>
                                    <th>Deductions</th>
                                    <th>Net Pay</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <a href="#" class="link-default">PAY001245</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-sm rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-06.jpg')); ?>" 
                                                     class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-0">
                                                    <a href="#">David Wilson</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Engineering</td>
                                    <td class="text-dark">$5,250.00</td>
                                    <td class="text-danger">$525.00</td>
                                    <td class="text-success">$4,725.00</td>
                                    <td>15 Apr 2024</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="link-default">PAY001244</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-sm rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-07.jpg')); ?>" 
                                                     class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-0">
                                                    <a href="#">Lisa Anderson</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Marketing</td>
                                    <td class="text-dark">$4,800.00</td>
                                    <td class="text-danger">$432.00</td>
                                    <td class="text-success">$4,368.00</td>
                                    <td>14 Apr 2024</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="link-default">PAY001243</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-sm rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-08.jpg')); ?>" 
                                                     class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-0">
                                                    <a href="#">Robert Taylor</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Sales</td>
                                    <td class="text-dark">$3,950.00</td>
                                    <td class="text-danger">$375.00</td>
                                    <td class="text-success">$3,575.00</td>
                                    <td>14 Apr 2024</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="link-default">PAY001242</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-sm rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-09.jpg')); ?>" 
                                                     class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-0">
                                                    <a href="#">Maria Garcia</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>HR</td>
                                    <td class="text-dark">$4,200.00</td>
                                    <td class="text-danger">$378.00</td>
                                    <td class="text-success">$3,822.00</td>
                                    <td>13 Apr 2024</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="#" class="link-default">PAY001241</a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <a href="#" class="avatar avatar-sm rounded-circle me-2 flex-shrink-0">
                                                <img src="<?php echo e(asset('assets/backend/img/users/user-10.jpg')); ?>" 
                                                     class="rounded-circle" alt="img">
                                            </a>
                                            <div>
                                                <h6 class="fs-14 fw-medium mb-0">
                                                    <a href="#">James Miller</a>
                                                </h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Finance</td>
                                    <td class="text-dark">$5,500.00</td>
                                    <td class="text-danger">$550.00</td>
                                    <td class="text-success">$4,950.00</td>
                                    <td>12 Apr 2024</td>
                                    <td><span class="badge bg-success">Paid</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <!-- start row -->
    <div class="row">
        <div class="col-lg-12 col-xl-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body pb-1">
                    <div class="mb-3">
                        <h6 class="mb-1">Pending Payroll Approvals</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <a href="#" class="avatar avatar-md flex-shrink-0 me-2">
                                <img src="<?php echo e(asset('assets/backend/img/users/user-11.jpg')); ?>" 
                                     class="rounded-circle" alt="img">
                            </a>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">
                                    <a href="#">Thomas Lee</a>
                                </h6>
                                <p class="fs-13">Finance Dept</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-lg badge-soft-warning">$4,250.00</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <a href="#" class="avatar avatar-md flex-shrink-0 me-2">
                                <img src="<?php echo e(asset('assets/backend/img/users/user-12.jpg')); ?>" 
                                     class="rounded-circle" alt="img">
                            </a>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">
                                    <a href="#">Jennifer Hall</a>
                                </h6>
                                <p class="fs-13">Marketing Dept</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-lg badge-soft-warning">$3,850.50</span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="d-flex align-items-center">
                            <a href="#" class="avatar avatar-md flex-shrink-0 me-2">
                                <img src="<?php echo e(asset('assets/backend/img/users/user-13.jpg')); ?>" 
                                     class="rounded-circle" alt="img">
                            </a>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">
                                    <a href="#">Kevin Martin</a>
                                </h6>
                                <p class="fs-13">Engineering</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-lg badge-soft-warning">$5,220.25</span>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light btn-sm w-100 mt-2">View All Approvals</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 d-flex">
            <div class="card flex-fill">
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="mb-1">Salary Distribution by Department</h6>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg flex-shrink-0 me-2 bg-primary-subtle text-primary">
                                <i class="isax isax-briefcase"></i>
                            </div>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">Engineering</h6>
                                <p class="fs-13">45 Employees</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-sm bg-primary">32%</span>
                            <p class="fs-13">$78,500</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg flex-shrink-0 me-2 bg-success-subtle text-success">
                                <i class="isax isax-chart"></i>
                            </div>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">Sales</h6>
                                <p class="fs-13">28 Employees</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-sm bg-success">24%</span>
                            <p class="fs-13">$58,900</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between border-bottom pb-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg flex-shrink-0 me-2 bg-warning-subtle text-warning">
                                <i class="isax isax-megaphone"></i>
                            </div>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">Marketing</h6>
                                <p class="fs-13">22 Employees</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-sm bg-warning">18%</span>
                            <p class="fs-13">$44,200</p>
                        </div>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center">
                            <div class="avatar avatar-lg flex-shrink-0 me-2 bg-info-subtle text-info">
                                <i class="isax isax-people"></i>
                            </div>
                            <div>
                                <h6 class="fs-14 fw-semibold mb-1">HR & Admin</h6>
                                <p class="fs-13">18 Employees</p>
                            </div>
                        </div>
                        <div class="text-end">
                            <span class="badge badge-sm bg-info">12%</span>
                            <p class="fs-13">$29,500</p>
                        </div>
                    </div>
                    <a href="#" class="btn btn-light btn-sm w-100 mt-3">Detailed Analytics</a>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-xl-4 d-flex flex-column">
            <div class="card d-flex">
                <div class="card-body flex-fill">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1">Attendance Trend</p>
                            <h6 class="fs-16 fw-semibold">94%</h6>
                        </div>
                        <div>
                            <h6 class="fs-14 fw-semibold mb-1">+2.5% <i
                                    class="isax isax-arrow-circle-up4 text-success"></i></h6>
                            <p class="fs-13">vs last month</p>
                        </div>
                    </div>
                </div>
                <div id="attendance_trend"></div>
            </div>

            <div class="card d-flex mt-3">
                <div class="card-body flex-fill">
                    <h6 class="mb-3">Salary Components</h6>
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-1 mb-3">
                        <p class="d-flex align-items-center fs-13 text-dark mb-0">
                            <i class="fa-solid fa-circle fs-8 me-1 text-primary"></i>Basic
                        </p>
                        <p class="d-flex align-items-center fs-13 text-dark mb-0">
                            <i class="fa-solid fa-circle fs-8 me-1 text-success"></i>HRA
                        </p>
                        <p class="d-flex align-items-center fs-13 text-dark mb-0">
                            <i class="fa-solid fa-circle fs-8 me-1 text-warning"></i>Allowances
                        </p>
                    </div>
                    <div id="salary_components"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

</div>
<!-- End Content -->

<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    // Salary Chart (replacing Commission Chart)
    var salaryOptions = {
        series: [{
            name: 'Gross Salary',
            data: [45000, 52000, 49000, 58000, 60000, 65000, 70000, 75000, 82000]
        }, {
            name: 'Net Paid',
            data: [40000, 47000, 44000, 52000, 54000, 59000, 63000, 68000, 74000]
        }],
        chart: {
            height: 200,
            type: 'area',
            toolbar: {
                show: false
            }
        },
        colors: ['#0d6efd', '#198754'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'smooth'
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep']
        },
        tooltip: {
            x: {
                format: 'MMM'
            }
        }
    };

    var salaryChart = new ApexCharts(document.querySelector("#salary_chart"), salaryOptions);
    salaryChart.render();

    // Attendance Trend Chart (replacing Network Growth)
    var attendanceOptions = {
        series: [{
            name: 'Attendance %',
            data: [92, 94, 93, 95, 94, 96, 97, 95, 98]
        }],
        chart: {
            height: 100,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#0d6efd'],
        dataLabels: {
            enabled: false
        },
        stroke: {
            curve: 'straight'
        },
        grid: {
            show: false
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            },
            axisTicks: {
                show: false
            }
        },
        yaxis: {
            show: false,
            max: 100
        }
    };

    var attendanceChart = new ApexCharts(document.querySelector("#attendance_trend"), attendanceOptions);
    attendanceChart.render();

    // Salary Components Chart (replacing Commission Distribution)
    var componentsOptions = {
        series: [50, 30, 20],
        chart: {
            height: 150,
            type: 'donut',
        },
        colors: ['#0d6efd', '#198754', '#ffc107'],
        labels: ['Basic', 'HRA', 'Allowances'],
        legend: {
            show: false
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '70%'
                }
            }
        }
    };

    var componentsChart = new ApexCharts(document.querySelector("#salary_components"), componentsOptions);
    componentsChart.render();
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\wamp64\www\hrm\resources\views/backend/dashboard.blade.php ENDPATH**/ ?>