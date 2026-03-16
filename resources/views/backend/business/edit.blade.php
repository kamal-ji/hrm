@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6>
                        <a href="{{ route('business.index') }}">
                            <i class="isax isax-arrow-left me-2"></i>Business
                        </a>
                    </h6>
                </div>

                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Update Business</h5>

                        <form action="{{ route('business.update',$user->id) }}" id="createForm" enctype="multipart/form-data">

                            {{-- ================= PERSONAL INFO ================= --}}
                            <h4>Personal Information</h4>

                            <div class="row gx-3">

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">First Name *</label>
                                        <input type="text" class="form-control" name="first_name"
                                               value="{{ $user->first_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Last Name *</label>
                                        <input type="text" class="form-control" name="last_name"
                                               value="{{ $user->last_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Mobile *</label>
                                        <input type="text" class="form-control" name="mobile"
                                               value="{{ $user->mobile }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Email *</label>
                                        <input type="text" class="form-control" name="email"
                                               value="{{ $user->email }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Password</label>
                                        <input type="password" class="form-control" name="password">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>

                                    @if ($user->image)
                                        <img src="{{ asset('storage/'.$user->image) }}"
                                             style="width:100px;height:100px">
                                    @endif
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Status *</label>
                                        <select class="form-control" name="status">
                                            <option value="active" {{ $user->status=='active'?'selected':'' }}>Active</option>
                                            <option value="inactive" {{ $user->status=='inactive'?'selected':'' }}>Inactive</option>
                                        </select>
                                    </div>
                                </div>

                            </div>


                            {{-- ================= BUSINESS INFO ================= --}}
                            <h4 class="mt-4">Business Information</h4>

                            <div class="row gx-3">

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Business Name *</label>
                                        <input type="text" class="form-control" name="business_name"
                                               value="{{ $business->business_name }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Business Type *</label>
                                        <input type="text" class="form-control" name="business_type"
                                               value="{{ $business->business_type }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Industry Type</label>
                                        <input type="text" class="form-control" name="industry_type"
                                               value="{{ $business->industry_type }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Business Category</label>
                                        <input type="text" class="form-control" name="business_category"
                                               value="{{ $business->business_category }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Alternate Mobile</label>
                                        <input type="text" class="form-control" name="alternate_mobile"
                                               value="{{ $business->alternate_mobile }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Designation</label>
                                        <input type="text" class="form-control" name="designation"
                                               value="{{ $business->designation }}">
                                    </div>
                                </div>

                            </div>


                            {{-- ================= ADDRESS ================= --}}
                            <h4 class="mt-4">Address</h4>

                            <div class="row gx-3">

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address Line 1</label>
                                        <input type="text" class="form-control" name="address_line1"
                                               value="{{ $business->address_line1 }}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label class="form-label">Address Line 2</label>
                                        <input type="text" class="form-control" name="address_line2"
                                               value="{{ $business->address_line2 }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">City</label>
                                        <input type="text" class="form-control" name="city"
                                               value="{{ $business->city }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <input type="text" class="form-control" name="state"
                                               value="{{ $business->state }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control" name="pincode"
                                               value="{{ $business->pincode }}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <input type="text" class="form-control" name="country"
                                               value="{{ $business->country }}">
                                    </div>
                                </div>

                            </div>


                            {{-- ================= LEGAL ================= --}}
                            <h4 class="mt-4">Legal Information</h4>

                            <div class="row gx-3">

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">GST Number</label>
                                        <input type="text" class="form-control" name="gst_number"
                                               value="{{ $business->gst_number }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">PAN Number</label>
                                        <input type="text" class="form-control" name="pan_number"
                                               value="{{ $business->pan_number }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Business Registration Number</label>
                                        <input type="text" class="form-control" name="registration_number"
                                               value="{{ $business->registration_number }}">
                                    </div>
                                </div>

                            </div>


                            {{-- ================= SUBSCRIPTION ================= --}}
                            <h4 class="mt-4">Subscription</h4>

                            <div class="row gx-3">

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Subscription Plan</label>
                                        <input type="text" class="form-control" name="subscription_plan"
                                               value="{{ $business->subscription_plan }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Billing Cycle</label>
                                        <select class="form-control" name="billing_cycle">
                                            <option value="monthly" {{ $business->billing_cycle=='monthly'?'selected':'' }}>Monthly</option>
                                            <option value="yearly" {{ $business->billing_cycle=='yearly'?'selected':'' }}>Yearly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Invoice Email</label>
                                        <input type="text" class="form-control" name="invoice_email"
                                               value="{{ $business->invoice_email }}">
                                    </div>
                                </div>

                            </div>


                            {{-- ================= SALARY ================= --}}
                            <h4 class="mt-4">Salary Settings</h4>

                            <div class="row gx-3">

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Salary Cycle</label>
                                        <select class="form-control" name="salary_cycle">
                                            <option value="monthly" {{ $business->salary_cycle=='monthly'?'selected':'' }}>Monthly</option>
                                            <option value="weekly" {{ $business->salary_cycle=='weekly'?'selected':'' }}>Weekly</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Salary Payment Date</label>
                                        <input type="number" class="form-control" name="salary_payment_date"
                                               value="{{ $business->salary_payment_date }}">
                                    </div>
                                </div>

                                <div class="col-lg-4">
                                    <div class="mb-3">
                                        <label class="form-label">Working Days Per Month</label>
                                        <input type="number" class="form-control" name="working_days_per_month"
                                               value="{{ $business->working_days_per_month }}">
                                    </div>
                                </div>

                            </div>


                            {{-- ================= SUBMIT ================= --}}
                            <div class="d-flex align-items-center justify-content-between pt-4 border-top">

                                <button type="submit" class="btn btn-primary submitBtn">
                                    Update
                                </button>

                                <div class="spinner-border spinner-border-sm d-none loadingSpinner">
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection