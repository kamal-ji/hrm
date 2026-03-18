@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('staff.index') }}"><i class="isax isax-arrow-left me-2"></i>Staff</a></h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Staff</h5>
                            <form action="{{ route('staff.store') }}" id="createForm" enctype="multipart/form-data">

                                <h6>Personal Information</h6>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="first_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="last_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mobile <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="mobile">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="email">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Password <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="password" class="form-control" name="password">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Image <span class="text-danger ms-1">*</span></label>
                                            <input type="file" class="form-control" name="image" accept="image/*">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="active">Active</option>
                                                <option value="inactive">Inactive</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Gender <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="gender">
                                                <option value="male">Male</option>
                                                <option value="female">Female</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Date of Birth <span class="text-danger ms-1">*</span></label>
                                            <input type="date" class="form-control" name="date_of_birth">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Marital Status <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control"  name="marital_status" required>
                                                <option value="single">Single</option>
                                                <option value="married">Married</option>
                                                <option value="divorced">Divorced</option>
                                                <option value="widowed">Widowed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Blood Group <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control"  name="blood_group" required>
                                                <option value="A+">A+</option>
                                                <option value="A-">A-</option>
                                                <option value="B+">B+</option>
                                                <option value="B-">B-</option>
                                                <option value="AB+">AB+</option>
                                                <option value="AB-">AB-</option>
                                                <option value="O+">O+</option>
                                                <option value="O-">O-</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Emergency Contact <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="emergency_contact">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Father Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="father_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mother Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="mother_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Spouse Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="spouse_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Physically Challenged<span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="physically_challenged">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h6>Current Address</h6>
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 1<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[address_1]" id="current_address_1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 2<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[address_2]" id="current_address_2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[city]" id="current_city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[state]" id="current_state">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Country<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[country]" id="current_country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="current[postal_code]" id="current_postal_code">
                                        </div>
                                    </div>
                                    
                                </div>

                                <h6>Permanent Address</h6>
                                <div class="row gx-3">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 1<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[address_1]" id="permanent_address_1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 2<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[address_2]" id="permanent_address_2">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[city]" id="permanent_city">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[state]" id="permanent_state">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Country<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[country]" id="permanent_country">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Postal Code<span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="permanent[postal_code]" id="permanent_postal_code">
                                        </div>
                                    </div>
                                    
                                </div>

                                <h6 class="mt-4">Staff Information</h6>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Employee Identifier <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="employee_identifier">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Department <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="department">
                                                <option value="">Select Department</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Designation <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="designation">
                                                <option value="">Select Designation</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Joining Date <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="date" class="form-control" name="joining_date">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mt-4">Salary Information</h6>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Salary Cycle <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="salary_cycle">
                                                @for ($i = 1; $i <= 28; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                                <option value="last">Last Day</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Staff Type <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="staff_type">
                                                <option value="">Select Staff Type</option>
                                                <option value="hourly-regular">Hourly Regular</option>
                                                <option value="monthly-regular">Monthly Regular</option>
                                                <option value="hourly-contract">Hourly Contract</option>
                                                <option value="monthly-contract">Monthly Contract</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Opening Balance <span
                                                    class="text-danger ms-1">*</span></label>
                                            <div class="input-group">
                                                <select class="form-control" name="opening_balance_type">
                                                    <option value="pending">Pending</option>
                                                    <option value="paid">Paid</option>
                                                </select>
                                                <input type="number" class="form-control" name="opening_balance"
                                                    placeholder="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Salary Details Access <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="salary_details_access">
                                                <option value="">Select Access</option>
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mt-4">Earnings</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Enable?</th>
                                            <th>Salary Type</th>
                                            <th>Amount <span xrole="earnings-total"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allowances as $allowance)
                                            <tr xrole="employee-allowance-row">
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            data-id="{{ $allowance->id }}"
                                                            id="allowance-{{ $allowance->id }}" xrole="allowance-enable"
                                                            name="allowance[{{ $allowance->id }}][enabled]"
                                                            onchange="updateData()" value="1">
                                                        <label class="form-check-label"
                                                            for="allowance-{{ $allowance->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $allowance->name }}</td>
                                                <td>
                                                    <input type="number" class="form-control"
                                                        name="allowance[{{ $allowance->id }}][amount]" placeholder="0.00"
                                                        onchange="updateData()">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h6 class="mt-4">Deductions</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Enable?</th>
                                            <th>Salary Type</th>
                                            <th>Config</th>
                                            <th>Amount <span xrole="deductions-total"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deductions as $deduction)
                                            <tr xrole="employee-deduction-row">
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            data-id="{{ $deduction->id }}"
                                                            id="deduction-{{ $deduction->id }}" xrole="deduction-enable"
                                                            name="deductions[{{ $deduction->id }}][enabled]"
                                                            onchange="updateData()" value="1">
                                                        <label class="form-check-label"
                                                            for="deduction-{{ $deduction->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $deduction->name }}</td>
                                                <td>
                                                    <input type="hidden" name="deductions[{{ $deduction->id }}][type]"
                                                        value="fixed">

                                                    <ul class="nav nav-tabs" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link nav-link-deduct-type active"
                                                                id="fixed-tab-{{ $deduction->id }}" data-bs-toggle="tab"
                                                                data-bs-target="#fixed-tab-pane-{{ $deduction->id }}"
                                                                type="button" role="tab"
                                                                aria-controls="fixed-tab-pane-{{ $deduction->id }}"
                                                                aria-selected="true">Fixed</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link nav-link-deduct-type"
                                                                id="variable-tab-{{ $deduction->id }}"
                                                                data-bs-toggle="tab"
                                                                data-bs-target="#variable-tab-pane-{{ $deduction->id }}"
                                                                type="button" role="tab"
                                                                aria-controls="variable-tab-pane-{{ $deduction->id }}"
                                                                aria-selected="false">Variable</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane fade p-1 show active"
                                                            id="fixed-tab-pane-{{ $deduction->id }}" role="tabpanel"
                                                            aria-labelledby="fixed-tab-{{ $deduction->id }}"
                                                            tabindex="0">
                                                            <div class="input-group mb-2">
                                                                <input type="number" class="form-control"
                                                                    name="deductions[{{ $deduction->id }}][fixed_amount]"
                                                                    min="0" value="1800" step="0.01"
                                                                    onchange="updateData()">
                                                                <span class="input-group-text">Fixed</span>
                                                            </div>
                                                            @foreach ($allowances as $allowance)
                                                                <div>
                                                                    <input type="checkbox"
                                                                        name="deductions[{{ $deduction->id }}][fixed][]"
                                                                        onchange="updateData()"
                                                                        value="{{ $allowance->id }}"> &nbsp;
                                                                    {{ $allowance->name }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                        <div class="tab-pane fade p-1"
                                                            id="variable-tab-pane-{{ $deduction->id }}" role="tabpanel"
                                                            aria-labelledby="variable-tab-{{ $deduction->id }}"
                                                            tabindex="0">
                                                            <div class="input-group mb-2">
                                                                <input type="number" class="form-control"
                                                                    name="deductions[{{ $deduction->id }}][variable_percentage]"
                                                                    min="0" max="100" value="12"
                                                                    step="0.01" onchange="updateData()">
                                                                <span class="input-group-text">% of</span>
                                                            </div>
                                                            @foreach ($allowances as $allowance)
                                                                <div>
                                                                    <input type="checkbox"
                                                                        name="deductions[{{ $deduction->id }}][variable][]"
                                                                        onchange="updateData()"
                                                                        value="{{ $allowance->id }}"> &nbsp;
                                                                    {{ $allowance->name }}
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </td>
                                                <td xrole="employee-deduction">

                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h6 class="mt-4">Employer Contributions</h6>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Enable?</th>
                                            <th>Salary Type</th>
                                            <th>Amount <span xrole="contributions-total"></span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deductions as $deduction)
                                            <tr xrole="employee-contribution-row">
                                                <td>
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input" type="checkbox"
                                                            data-id="{{ $deduction->id }}"
                                                            id="contribution-{{ $deduction->id }}" xrole="contribution-enable"
                                                            name="contributions[{{ $deduction->id }}][enabled]"
                                                            onchange="updateData()" value="1">
                                                        <label class="form-check-label"
                                                            for="contribution-{{ $deduction->id }}"></label>
                                                    </div>
                                                </td>
                                                <td>{{ $deduction->name }}</td>
                                                <td xrole="employee-contribution-{{ $deduction->id }}">
                                                    <input type="number" class="form-control" name="contributions[{{ $deduction->id }}][amount]" value="0" onchange="updateData()">
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Gross Pay</td>
                                            <th xrole="gross-pay"></th>
                                        </tr>
                                        <tr>
                                            <td>CTC</td>
                                            <th xrole="ctc"></th>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                    <button type="submit" class="btn btn-primary submitBtn">Submit</button>

                                    <div class="spinner-border spinner-border-sm d-none loadingSpinner" role="status">
                                        <span class="visually-hidden">Loading...</span>
                                    </div>
                                </div>
                            </form>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div>
            </div><!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- End Content -->
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#createForm').on('submit', async function(e) {
                e.preventDefault();

                $('.submitBtn').prop('disabled', true);
                $('.loadingSpinner').removeClass('d-none');

                const formData = new FormData(this);

                $.ajax({
                    url: this.action,
                    method: 'POST',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message ||
                                'Staff created successfully');
                            window.location.href = response.redirect_url
                        } else {
                            showError(response.message || 'Something went wrong');
                        }
                    },
                    error: function(xhr) {
                        $('.form-error').remove();

                        if (xhr.responseJSON && xhr.responseJSON.errors) {
                            for (let field in xhr.responseJSON.errors) {
                                if (xhr.responseJSON.errors.hasOwnProperty(field)) {
                                    let errorMsg = xhr.responseJSON.errors[field][0];

                                    // Find the field's input or label element
                                    let fieldElement = $('[name="' + field + '"]');

                                    // Create an error message element
                                    let errorElement = $('<div class="form-error"></div>')
                                        .text(errorMsg);

                                    // Append the error message below the field
                                    fieldElement.after(errorElement);
                                }
                            }

                        } else if (xhr.responseJSON.message) {
                            showError(xhr.responseJSON.message || 'An error occurred');
                        } else {
                            // If no specific error, show a generic error
                            showError('An error occurred');
                        }
                    },
                    complete: function() {
                        $('.submitBtn').prop('disabled', false);
                        $('.loadingSpinner').addClass('d-none');
                    }
                });
            });
        });

        // Handle tab change for deduction type
        $(document).on('click', '.nav-link-deduct-type', function() {
            var tabId = $(this).attr('id');
            var deductionId = tabId.split('-')[2];
            var type = tabId.includes('fixed') ? 'fixed' : 'variable';

            $('input[name="deductions[' + deductionId + '][type]"]').val(type);
            updateData();
        });
    </script>

    <script>
        function updateData() {
            var allowances = {};
            var deductions = {};
            var contributions = {};

            jQuery('[xrole="employee-allowance-row"]').each(function() {
                var allowanceId = $(this).find('[xrole="allowance-enable"]').data('id');
                var enabled = $(this).find('[xrole="allowance-enable"]').is(':checked');
                var amount = $(this).find('[name="allowance[' + allowanceId + '][amount]"]').val() || 0;

                allowances[allowanceId] = {
                    enabled: enabled,
                    amount: enabled ? parseFloat(amount) : 0
                };
            });

            jQuery('[xrole="employee-deduction-row"]').each(function() {
                var deductionId = $(this).find('[xrole="deduction-enable"]').data('id');
                var enabled = $(this).find('[xrole="deduction-enable"]').is(':checked');
                var type = $(this).find('[name="deductions[' + deductionId + '][type]"]').val();
                
                var amount = 0;
                var includes = [];

                $(this).find('[name="deductions[' + deductionId + '][' + type + '][]"]:checked').each(function(
                    index, item) {
                    var allowanceId = $(item).val();

                    includes.push(allowanceId);

                    const allowance = allowances[allowanceId];
                    amount += (allowance.enabled ? parseFloat(allowance.amount) : 0);
                });

                if (type == 'fixed') {
                    amount = $(this).find('[name="deductions[' + deductionId + '][fixed_amount]"]').val() || 0;
                } else {
                    const percentage = $(this).find('[name="deductions[' + deductionId + '][variable_percentage]"]').val() || 0;
                    amount = (amount * percentage) / 100;
                }
                
                deductions[deductionId] = {
                    enabled: enabled,
                    type: type,
                    includes: includes,
                    amount: amount
                };   

                jQuery(this).find('[xrole="employee-deduction"]').text(enabled ? amount : '');
            });

            jQuery('[xrole="employee-contribution-row"]').each(function() {
                var contributionId = $(this).find('[xrole="contribution-enable"]').data('id');
                var enabled = $(this).find('[xrole="contribution-enable"]').is(':checked');
                var amount = $(this).find('[name="contributions[' + contributionId + '][amount]"]').val();

                const deduction = deductions[contributionId];

                if(deduction.enabled === false){
                    enabled = false;
                    $(this).find('[name="contributions[' + contributionId + '][enabled]"]').prop('checked', false);
                }

                amount = deduction.amount || 0;
                $(this).find('[name="contributions[' + contributionId + '][amount]"]').val(amount);

                contributions[contributionId] = {
                    enabled: enabled,
                    amount: (enabled) ? parseFloat(amount) : 0
                };
            });

            const allowanceSum = Object.values(allowances).reduce((sum, allowance) => sum + (allowance.enabled ? parseFloat(allowance.amount) : 0), 0);
            jQuery('[xrole="earnings-total"]').text(allowanceSum);

            const deductionSum = Object.values(deductions).reduce((sum, deduction) => sum + (deduction.enabled ? parseFloat(deduction.amount) : 0), 0);
            jQuery('[xrole="deductions-total"]').text(deductionSum);

            const contributionSum = Object.values(contributions).reduce((sum, contribution) => sum + (contribution.enabled ? parseFloat(contribution.amount) : 0), 0);
            jQuery('[xrole="contributions-total"]').text(contributionSum);

            jQuery('[xrole="gross-pay"]').text(allowanceSum);

            const ctc = allowanceSum + contributionSum;
            jQuery('[xrole="ctc"]').text(ctc);
        }
    </script>
@endpush
