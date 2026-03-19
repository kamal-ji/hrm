@extends('layouts.admin')

@section('content')
    <style>
        .sidebar {
            height: 100vh;
            background: #fff;
            border-right: 1px solid #eee;
        }

        .profile-header {
            background: linear-gradient(to right, #dfe9f3, #ffffff);
            border-radius: 10px;
            padding: 20px;
        }

        .avatar {
            width: 50px;
            height: 50px;
            background: #0d6efd;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        .card-section {
            border-radius: 10px;
        }

        .section-title {
            font-weight: 600;
        }

        .label {
            font-size: 13px;
            color: #888;
        }

        .value {
            font-weight: 500;
        }
    </style>

    <!-- Start Content -->
    <div class="content">
        <!-- Header -->
        <div class="profile-header d-flex justify-content-between align-items-center mb-4">
            <div class="d-flex align-items-center gap-3">
                <div class="avatar">Ka</div>
                <div>
                    <h5 class="mb-0">kamal</h5>
                    <small class="text-muted">{{ $staff->staff_type }}</small>
                </div>
            </div>

            <button class="btn btn-light border">
                Actions <i class="fas fa-chevron-down"></i>
            </button>
        </div>

        <!-- Profile Info -->
        <div class="card card-section p-3 mb-3">
            <div class="d-flex justify-content-between mb-3">
                <div class="section-title">Profile Information</div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="label">Name</div>
                    <div class="value">{{ $user->full_name }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">ID</div>
                    <div class="value">{{ $staff->employee_identifier }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Designation</div>
                    <div class="value">{{ $staff->designation ? $staff->designation->name : '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Salary Cycle</div>
                    <div class="value">{{ $staff->salary_cycle }}</div>
                </div>
            </div>
        </div>

        <!-- Personal Info -->
        <div class="card card-section p-3 mb-3">
            <div class="d-flex justify-content-between mb-3">
                <div class="section-title">Personal Information</div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="label">Email</div>
                    <div class="value">{{ $user->email }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Gender</div>
                    <div class="value">{{ $staff->gender }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Date of Birth</div>
                    <div class="value">{{ $staff->date_of_birth }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Marital Status</div>
                    <div class="value">{{ $staff->marital_status }}</div>
                </div>
            </div>
        </div>

        <!-- Employment Info -->
        <div class="card card-section p-3 mb-3">
            <div class="d-flex justify-content-between mb-3">
                <div class="section-title">Employment Information</div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="label">Date of Joining</div>
                    <div class="value">{{ $staff->joining_date ? $staff->joining_date->format('d/m/Y') : '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">UAN</div>
                    <div class="value">{{ $staff->uan_number }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">PAN Number</div>
                    <div class="value">{{ $staff->pan_number }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Aadhaar Number</div>
                    <div class="value">{{ $staff->aadhaar_number }}</div>
                </div>
            </div>
        </div>

        <!-- Bank Info -->
        <div class="card card-section p-3 mb-3">
            <div class="d-flex justify-content-between mb-3">
                <div class="section-title">Bank Details</div>
            </div>

            <div class="row">
                <div class="col-md-3">
                    <div class="label">Bank Name</div>
                    <div class="value">{{ $staff->bank_name ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">IFSC Code</div>
                    <div class="value">{{ $staff->bank_ifsc_code ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Account Number</div>
                    <div class="value">{{ $staff->bank_ac_number ?? '-' }}</div>
                </div>
                <div class="col-md-3">
                    <div class="label">Account Holder</div>
                    <div class="value">{{ $staff->bank_ac_holder ?? '-' }}</div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Content -->
@endsection
