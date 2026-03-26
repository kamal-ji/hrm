@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('leave-policy.index') }}"><i class="isax isax-arrow-left me-2"></i>Leave Policies</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Leave Policy</h5>
                            <form action="{{ route('leave-policy.store') }}" id="createForm" enctype="multipart/form-data">
                                
                                <div class="row gx-3">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Template Name <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Leave Policy Cycle <span class="text-danger ms-1">*</span></label>
                                            <select class="form-select" name="cycle" id="cycle" required>
                                                @foreach(\App\Helpers\Constants::getLeavePolicyCycles() as $cycle)
                                                    <option value="{{ $cycle['id'] }}">{{ $cycle['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="d-flex align-items-center justify-content-between">
                                            <p>Leave Categories</p>
                                            <button type="button" class="btn btn-primary" onclick="addLeaveCategory()">Add Leave Category</button>
                                        </div>

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Leave Type</th>
                                                    <th>Max Leave</th>
                                                    <th>Unused Leave Rule</th>
                                                    <th>Carry Forward Limit</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody xrole="leave_categories">
                                                <!-- Dynamic rows will be added here -->
                                            </tbody>
                                        </table>
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
    <script src="{{ asset('assets/backend/js/custom.js') }}"></script>

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
                                'Leave Policy created successfully');
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

    <script>
        var leaveCategoryCount = 0;
       function addLeaveCategory() {
    jQuery('[xrole="leave_categories"]').append(`
        <tr xrole="leave_category">
            <td>
                <input type="text" class="form-control" name="categories[${leaveCategoryCount}][name]" placeholder="eg. Casual Leave">
            </td>
            <td>
                <input type="number" class="form-control" name="categories[${leaveCategoryCount}][max_leave]" placeholder="Leave count">
            </td>
            <td>
                <select class="form-control leaverule" name="categories[${leaveCategoryCount}][unused_leave_rule]">
                    @foreach(\App\Helpers\Constants::getLeavePolicyUnusedLeaveRules() as $rule)
                        <option value="{{ $rule['id'] }}">{{ $rule['name'] }}</option>
                    @endforeach
                </select>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" 
                        class="form-control carry_forward_limit" 
                        name="categories[${leaveCategoryCount}][carry_forward_limit]" 
                        placeholder="Carry Forward Limit" 
                        readonly>
                    <span class="input-group-text">Days</span>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger" onclick="removeLeaveCategory(this)">Remove</button>
            </td>
        </tr>
    `);

    leaveCategoryCount++;
}
        
        function removeLeaveCategory(button) {
            button.closest('tr').remove();
        }

      
    jQuery(document).on('change', '.leaverule', function () {
        var selectedText = jQuery(this).find('option:selected').text().toLowerCase();
        var row = jQuery(this).closest('tr');
        var input = row.find('.carry_forward_limit');

        if (selectedText.includes('expire')) {
            input.prop('readonly', true).val('');
        } else {
            input.prop('readonly', false);
        }
    });
    </script>
@endpush
