@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('attendance-template.index') }}"><i class="isax isax-arrow-left me-2"></i>Attendance Template</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Attendance Template</h5>
                            <form action="{{ route('attendance-template.store') }}" id="createForm" enctype="multipart/form-data">
                                
                                <div class="row gx-3">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Template Name <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Attendance Mode <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="attendance_mode" required onchange="showDescription(this, 'attendance_mode')">
                                                <option value="">Select Attendance Mode</option>
                                                @foreach(\App\Helpers\Constants::getAttendanceModes() as $mode)
                                                    <option value="{{ $mode['id'] }}" data-description="{{ $mode['description'] }}">{{ $mode['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span id="attendance_mode_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Attendance on Holiday <span class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="attendance_on_holiday" required onchange="showDescription(this, 'attendance_on_holiday')">
                                                <option value="">Select Attendance on Holiday</option>
                                                @foreach(\App\Helpers\Constants::getHolidayAttendanceModes() as $mode)
                                                    <option value="{{ $mode['id'] }}" data-description="{{ $mode['description'] }}" >{{ $mode['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span id="attendance_on_holiday_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Track In &amp; Out Time</label>
                                            <select class="form-control" name="track_in_out_time" data-ha-name="track_in_out_time" data-ha-container="#createForm" data-ha-callback="toggler">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                            <span id="track_in_out_time_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" data-ha-relative="track_in_out_time" data-ha-equal="1">
                                        <div class="mb-2">
                                            <label class="form-label">No attendance without punch-out</label>
                                            <select class="form-control" name="no_attendance_without_punch_out">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" data-ha-relative="track_in_out_time" data-ha-equal="1">
                                        <div class="mb-2">
                                            <label class="form-label">Allow Multiple Punches</label>
                                            <select class="form-control" name="allow_multiple_punches">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Enable Auto Approval</label>
                                            <select class="form-control" name="enable_auto_approval" data-ha-name="enable_auto_approval" data-ha-container="#createForm" data-ha-callback="toggler">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" data-ha-relative="enable_auto_approval" data-ha-equal="1">
                                        <div class="mb-2">
                                            <label class="form-label">Attendance Items</label>
                                            <select class="form-control select2" name="attendance_items[]" multiple>
                                                @foreach(\App\Helpers\Constants::getAttendanceItems() as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span id="attendance_items_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" data-ha-relative="enable_auto_approval" data-ha-equal="1">
                                        <div class="mb-2">
                                            <label class="form-label">Automation Items</label>
                                            <select class="form-control select2" name="automation_items[]" multiple>
                                                @foreach(\App\Helpers\Constants::getAutomationItems() as $item)
                                                    <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                                @endforeach
                                            </select>
                                            <span id="automation_items_description"></span>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12" data-ha-relative="enable_auto_approval" data-ha-equal="1">
                                        <div class="mb-2">
                                            <label class="form-label">Approval Days</label>
                                            <input type="number" min="0" class="form-control" name="approval_days">
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Mark Absent on Previous Days</label>
                                            <select class="form-control" name="mark_absent_on_previous_days">
                                                <option value="1">Yes</option>
                                                <option value="0">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Effective Working Hours</label>
                                            <select class="form-control" name="effective_working_hours" onchange="showDescription(this, 'effective_working_hours')">
                                                <option value="">Select Effective Working Hours</option>
                                                @foreach(\App\Helpers\Constants::getEffectiveWorkingHours() as $hour)
                                                    <option value="{{ $hour['id'] }}" data-description="{{ $hour['description'] }}">{{ $hour['name'] }}</option>
                                                @endforeach 
                                            </select>
                                            <span id="effective_working_hours_description"></span>
                                        </div>
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
                                'Attendance Template created successfully');
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
        function showDescription(selectElement, fieldName) {
            const selectedOption = selectElement.options[selectElement.selectedIndex];
            const description = selectedOption.getAttribute('data-description');
            const descriptionElement = document.getElementById(fieldName + '_description');
            
            if (descriptionElement) {
                descriptionElement.textContent = description || '';
            }
        }
    </script>
@endpush
