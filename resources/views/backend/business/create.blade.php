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
                                            <input type="text" class="form-control"
                                                name="business_registration_number">
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
                                            <input type="text" class="form-control" name="payment_method">
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
                                            <label class="form-label">Working Days Per Month</label>
                                            <input type="number" class="form-control" name="working_days_per_month">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Default Shift Time</label>
                                            <input type="text" class="form-control" name="default_shift_time">
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

                                <h6 class="mt-4">Payment Gateways</h6>

                                <div class="row gx-3">

                                    <div class="col-md-3"><label><input type="checkbox" name="allow_upi" value="1">
                                            UPI</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_card"
                                                value="1"> Card</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_netbanking"
                                                value="1"> Net Banking</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_wallet"
                                                value="1"> Wallet</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_razorpay"
                                                value="1"> Razorpay</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_cashfree"
                                                value="1"> Cashfree</label></div>
                                    <div class="col-md-3"><label><input type="checkbox" name="allow_phonepe_pg"
                                                value="1"> PhonePe PG</label></div>

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
