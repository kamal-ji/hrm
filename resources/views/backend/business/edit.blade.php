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
                            <h5 class="mb-3">Update Business</h5>
                            <form action="{{ route('business.update', $user->id) }}" id="createForm"
                                enctype="multipart/form-data">

                                <h4>Personal Information</h4>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">First Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ $user->first_name }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Last Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $user->last_name }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Mobile <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="mobile"
                                                value="{{ $user->mobile }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Email <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="email"
                                                value="{{ $user->email }}">
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
                                            <input type="file" class="form-control" name="image">
                                        </div>
                                        @if ($user->image)
                                            <img src="{{ asset('storage/' . $user->image) }}" alt="User Image"
                                                style="width: 100px; height: 100px;">
                                        @endif
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Status <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="status">
                                                <option value="active"
                                                    {{ $user->status == 'active' ? 'selected' : '' }}>Active</option>
                                                <option value="inactive"
                                                    {{ $user->status == 'inactive' ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <h4 class="mt-4">Business Information</h4>
                                <div class="row gx-3">
                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="business_name"
                                                value="{{ $business->business_name }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Business Type <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="business_type"
                                                value="{{ $business->business_type }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Address <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $business->address }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">City <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ $business->city }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Subscription <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="subscription">
                                                <option value="trial"
                                                    {{ $business->subscription == 'trial' ? 'selected' : '' }}>Trial
                                                </option>
                                                <option value="active"
                                                    {{ $business->subscription == 'active' ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="expired"
                                                    {{ $business->subscription == 'expired' ? 'selected' : '' }}>Expired
                                                </option>
                                                <option value="cancelled"
                                                    {{ $business->subscription == 'cancelled' ? 'selected' : '' }}>
                                                    Cancelled</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex align-items-center justify-content-between pt-4 border-top">
                                    <button type="submit" class="btn btn-primary submitBtn">Update</button>
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
                formData.append('_method', 'PUT');

                $.ajax({
                    url: this.action,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message || 'Business update successfully');
                            window.location.href = response.redirect_url;
                        } else {
                            showError(response.message || 'Something went wrong');
                        }
                    },
                    error: function(xhr) {
                        $('.form-error').remove();
                        let errorMsg = 'An error occurred';
                        
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
                            errorMsg = xhr.responseJSON.message;
                            showError(errorMsg);
                        } else {
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
