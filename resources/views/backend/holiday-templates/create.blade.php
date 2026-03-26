@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('holiday-template.index') }}"><i class="isax isax-arrow-left me-2"></i>Holiday Template</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Holiday Template</h5>
                            <form action="{{ route('holiday-template.store') }}" id="createForm" enctype="multipart/form-data">
                                
                                <div class="row gx-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Template Name <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Holiday Period</label>
                                            <select class="form-control" name="year" id="year" onchange="updateDateRange()">
                                                <option value="">Select Year</option>
                                                @for($i = date('Y'); $i <= date('Y') + 10; $i++)
                                                    <option value="{{ $i }}">{{ $i }}</option>
                                                @endfor
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                        <div class="d-flex justify-content-between align-items-center">
                                            <p>
                                                Holiday List
                                            </p>
                                            <div>
                                                <button type="button" class="btn btn-primary" onclick="addHoliday()">Add Holiday</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div xrole="holidays">
                                            <!-- Holiday items will be added here -->
                                        </div>
                                    </div>
                                </div>

                                <br>
                                
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
                                'Holiday Template created successfully');
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

        let holidayCounter = 0;
        
        function addHoliday() {
            jQuery('[xrole="holidays"]').append(`<div class="input-group mb-2" xrole="holiday">
                <input type="text" name="holiday_dates[${holidayCounter}][name]" class="form-control" placeholder="Holiday Name">
                <input type="date" name="holiday_dates[${holidayCounter}][date]" xrole="holiday-date" class="form-control" placeholder="Date">
                <button type="button" class="btn btn-danger" onclick="removeHoliday(this)">Remove</button>
            </div>`);

            holidayCounter++;
        }
        
        function removeHoliday(button) {
            jQuery(button).closest('[xrole="holiday"]').remove();
        }

        function updateDateRange(){
            const year = $('#year').val();

            if(year){
                const minDate = year + '-01-01';
                const maxDate = year + '-12-31';
                $('[xrole="holiday-date"]').attr('min', minDate);
                $('[xrole="holiday-date"]').attr('max', maxDate);
            }
        }

        addHoliday();
    </script>
@endpush
