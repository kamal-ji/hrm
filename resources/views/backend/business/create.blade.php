@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('business.index') }}"><i class="isax isax-arrow-left me-2"></i>Business</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Business</h5>
                            <form action="{{ route('business.store') }}" id="createForm" enctype="multipart/form-data">

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
                                </div>

                                <h6 class="mt-4">Business Information</h6>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="business_name">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Type <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="business_type">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Industry Type</label>
                                            <input type="text" class="form-control" name="industry_type">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Category</label>
                                            <input type="text" class="form-control" name="business_category">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Number of Employees</label>
                                            <input type="number" class="form-control" name="number_of_employees">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Alternate Mobile</label>
                                            <input type="text" class="form-control" name="alternate_mobile">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Designation</label>
                                            <input type="text" class="form-control" name="designation">
                                        </div>
                                    </div>
                                </div>

                                <h6 class="mt-4">Address Information</h6>

                                <div class="row gx-3">

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 1</label>
                                            <input type="text" class="form-control" name="address_line_1">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" name="address_line_2">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City</label>
                                            <input type="text" class="form-control" name="city">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">State</label>
                                            <input type="text" class="form-control" name="state">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Pincode</label>
                                            <input type="text" class="form-control" name="pincode">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Country</label>
                                            <input type="text" class="form-control" name="country" value="India">
                                        </div>
                                    </div>

                                </div>

                                <h6 class="mt-4">Tax & Registration</h6>

                                <div class="row gx-3">

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">GST Number</label>
                                            <input type="text" class="form-control" name="gst_number">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">PAN Number</label>
                                            <input type="text" class="form-control" name="pan_number">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Registration Number</label>
                                            <input type="text" class="form-control" name="business_registration_number">
                                        </div>
                                    </div>

                                </div>

                                <h6 class="mt-4">Subscription & Billing</h6>

                                <div class="row gx-3">

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subscription Plan</label>
                                            <input type="text" class="form-control" name="subscription_plan">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Billing Cycle</label>
                                            <select class="form-control" name="billing_cycle">
                                                <option value="monthly">Monthly</option>
                                                <option value="yearly">Yearly</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Payment Method</label>
                                            <select class="form-control" name="payment_method">
                                                <option value="upi">UPI</option>
                                                <option value="card">Card</option>
                                                <option value="netbanking">Net Banking</option>
                                                <option value="wallet">Wallet</option>
                                                <option value="razorpay">Razorpay</option>
                                                <option value="cashfree">Cashfree</option>
                                                <option value="phonepe_pg">PhonePe PG</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Invoice Email</label>
                                            <input type="email" class="form-control" name="invoice_email">
                                        </div>
                                    </div>

                                </div>

                                <h6 class="mt-4">Salary Settings</h6>

                                <div class="row gx-3">

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Salary Cycle</label>
                                            <select class="form-control" name="salary_cycle">
                                                <option value="monthly">Monthly</option>
                                                <option value="weekly">Weekly</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Salary Payment Date</label>
                                            <input type="number" class="form-control" name="salary_payment_date">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Default Shift Time</label>
                                            <input type="text" class="form-control" name="default_shift_time">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <h5 class="fw-bold">Payable Days & Work Hours</h5>

                                        <p class="text-muted mb-4">
                                            What is the effective payable days per month, work hours per day in your organization?<br>
                                            We will calculate based on your selection salary / payable days, hourly wage rate = daily wage rate / number of work hours for salary calculation
                                        </p>

                                        <!-- Options -->
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="working_days_per_month" value="cal-month" id="calendarMonth" checked>
                                            <label class="form-check-label fw-semibold" for="calendarMonth">
                                                Calendar Month
                                            </label>
                                            <div class="option-desc">
                                                Ex: March will have 31 payable days, April will have 30 payable days etc.
                                            </div>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="working_days_per_month" value="30" id="month30">
                                            <label class="form-check-label fw-semibold" for="month30">
                                                Every Month 30 Days
                                            </label>
                                            <div class="option-desc">
                                                Ex: March will have 30 payable days, April will have 30 payable days etc.
                                            </div>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="working_days_per_month" value="28" id="month28">
                                            <label class="form-check-label fw-semibold" for="month28">
                                                Every Month 28 Days
                                            </label>
                                            <div class="option-desc">
                                                Ex: March will have 28 payable days, April will have 28 payable days etc.
                                            </div>
                                        </div>

                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="radio" name="working_days_per_month" value="26" id="month26">
                                            <label class="form-check-label fw-semibold" for="month26">
                                                Every Month 26 Days
                                            </label>
                                            <div class="option-desc">
                                                Ex: March will have 26 payable days, April will have 26 payable days etc.
                                            </div>
                                        </div>

                                        <div class="form-check mb-4">
                                            <input class="form-check-input" type="radio" name="working_days_per_month" value="exclude-weekly" id="excludeWeekly">
                                            <label class="form-check-label fw-semibold" for="excludeWeekly">
                                                Exclude Weekly Offs
                                            </label>
                                            <div class="option-desc">
                                                Ex: Month with 31 days and 4 weekly offs will have 27 payable days.
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <h6 class="mt-4">Notifications</h6>

                                <div class="row gx-3">
                                    <div class="col-md-3">
                                        <label><input type="checkbox" name="sms_notifications" value="1" checked>
                                            SMS</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label><input type="checkbox" name="whatsapp_alerts" value="1" checked>
                                            WhatsApp</label>
                                    </div>

                                    <div class="col-md-3">
                                        <label><input type="checkbox" name="email_alerts" value="1" checked>
                                            Email</label>
                                    </div>
                                </div>

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
                                'Business created successfully');
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
    </script>
@endpush
