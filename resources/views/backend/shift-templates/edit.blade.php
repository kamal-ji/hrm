@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('shift-template.index') }}"><i class="isax isax-arrow-left me-2"></i>Shift
                                Template</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Edit Shift Template</h5>
                            <form action="{{ route('shift-template.update', $template->id) }}" id="createForm" enctype="multipart/form-data">

                                <div class="row gx-3">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Shift Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name"
                                                required value="{{ $template->name }}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-2">
                                            <label class="form-label">Shift Type <span
                                                    class="text-danger ms-1">*</span></label>
                                            <select class="form-control" name="shift_type" required
                                                data-ha-name="shift_type" data-ha-container="#createForm"
                                                data-ha-callback="toggler">
                                                <option value="">Select Shift Type</option>
                                                @foreach (\App\Helpers\Constants::getShiftTypes() as $type)
                                                    <option value="{{ $type['id'] }}" {{ $type['id'] == $template->shift_type ? 'selected' : '' }}>{{ $type['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12" data-ha-relative="shift_type"
                                        data-ha-equal="{{ \App\Helpers\Constants::SHIFT_TYPE_FIXED }}">
                                        <hr>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12">
                                                <div class="mb-2">
                                                    <label class="form-label">Shift Code <span
                                                            class="text-danger ms-1">*</span></label>
                                                    <input type="text" class="form-control" name="fixed_shift_code"
                                                        id="fixed_shift_code" required value="{{ $template->fixed_shift_code }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr>
                                                <h5>Shift Timing</h5>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Shift Start Time <span
                                                            class="text-danger ms-1">*</span></label>
                                                    <input type="time" class="form-control" name="fixed_shift_start_time"
                                                        id="fixed_shift_start_time" required value="{{ $template->fixed_shift_start_time }}">
                                                </div>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Shift End Time <span
                                                            class="text-danger ms-1">*</span></label>
                                                    <input type="time" class="form-control" name="fixed_shift_end_time"
                                                        id="fixed_shift_end_time" required value="{{ $template->fixed_shift_end_time }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr>
                                                <h5>Buffer Minutes</h5>
                                            </div>

                                            <div class="col-lg-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Allowed Punch In Time</label>
                                                    <input type="time" class="form-control"
                                                        name="fixed_shift_buffer_start" id="fixed_shift_buffer_start" value="{{ $template->fixed_shift_buffer_start }}">
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="mb-2">
                                                    <label class="form-label">Allowed Punch Out Time </label>
                                                    <input type="time" class="form-control" name="fixed_shift_buffer_end"
                                                        id="fixed_shift_buffer_end" value="{{ $template->fixed_shift_buffer_end }}">
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <hr>
                                                <h5>Breaks</h5>
                                            </div>

                                            <div class="col-md-12">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Break Name</th>
                                                            <th>Pay Type</th>
                                                            <th>Break Type</th>
                                                            <th>Duration</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody xrole="breaks">

                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="5">
                                                                <button type="button" class="btn btn-primary add-break"
                                                                    onclick="addFixedBreakRow()">
                                                                    <i class="fas fa-plus"></i>
                                                                    Add Break
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" data-ha-relative="shift_type"
                                        data-ha-equal="{{ \App\Helpers\Constants::SHIFT_TYPE_OPEN }}">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label for="work_hours">Work Hours</label>
                                                <div class="input-group">
                                                    <select class="form-control" id="open_shift_work_hour"
                                                        name="open_shift_work_hour">
                                                        <option value="">Hours</option>
                                                        @for ($i = 0; $i < 24; $i++)
                                                            <option value="{{ $i }}" {{ hour_minute($template->open_shift_work_hour, 'h') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                    <select class="form-control" id="open_shift_work_minute"
                                                        name="open_shift_work_minute">
                                                        <option value="">Minutes</option>
                                                        @for ($i = 0; $i < 60; $i++)
                                                            <option value="{{ $i }}" {{ hour_minute($template->open_shift_work_hour, 'm') == $i ? 'selected' : '' }}>{{ $i }}
                                                            </option>
                                                        @endfor
                                                    </select>
                                                    <span class="input-group-text">Hours : Minutes</span>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <br>
                                                <label>
                                                    <input type="checkbox" class="form-check-input"
                                                        name="open_shift_show_action_buttons" value="1" {{ $template->open_shift_show_action_buttons ? 'checked' : '' }}>
                                                    Show Action Buttons
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12" data-ha-relative="shift_type"
                                        data-ha-equal="{{ \App\Helpers\Constants::SHIFT_TYPE_ROTATIONAL }}">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Rotational Shift Name</th>
                                                    <th>Start Time</th>
                                                    <th>End Time</th>
                                                    <th>Unpaid Break</th>
                                                    <th>Net Payable Hours</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody xrole="shifts">

                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="5">
                                                        <button type="button" class="btn btn-primary add-shift"
                                                            onclick="addShiftRow()">
                                                            <i class="fas fa-plus"></i>
                                                            Add Shift
                                                        </button>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
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

                if (!validateShiftLogic()) {
                    return false;
                }

                $('.submitBtn').prop('disabled', true);
                $('.loadingSpinner').removeClass('d-none');

                const formData = new FormData(this);

                $.ajax({
                    url: this.action,
                    method: 'PUT',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message ||
                                'Shift Template created successfully');
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

        var fixedBreakIndex = 0;

        function extract(payload, dataToExtract){
            if(!payload){
                return '';
            }

            if(dataToExtract in payload){
                return payload[dataToExtract];
            }

            return '';
        }

        function addFixedBreakRow(data = {}) {
            jQuery('[xrole="breaks"]').append(`
                <tr data-role="break_row" data-index="0">
                    <td>
                        <input type="text" class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][name]" placeholder="Break Name" value="${extract(data, 'name')}">
                    </td>
                    <td>
                        <select class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][pay_type]">
                            @foreach (\App\Helpers\Constants::getPayTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'pay_type') == '{{ $type['id'] }}' ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <select class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][type]" data-ha-name="fixed_shift_breaks_${fixedBreakIndex}_type" data-ha-container="#createForm" data-ha-callback="toggler">
                            @foreach (\App\Helpers\Constants::getTimePeriodTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') == '{{ $type['id'] }}' ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </td>
                    <td>
                        <div data-ha-relative="fixed_shift_breaks_${fixedBreakIndex}_type" data-ha-equal="duration">
                            <div class="input-group">
                                <select class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][hours]">
                                    <option value="">Hours</option>
                                    @foreach (range(0, 23) as $hour)
                                    <option value="{{ $hour }}" ${extract(data, 'hours') == '{{ $hour }}' ? 'selected' : ''}>{{ $hour }}</option>
                                    @endforeach
                                </select>
                                <select class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][minutes]">
                                    <option value="">Minutes</option>
                                    @foreach (range(0, 59) as $minute)
                                    <option value="{{ $minute }}" ${extract(data, 'minutes') == '{{ $minute }}' ? 'selected' : ''}>{{ $minute }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="input-group" data-ha-relative="fixed_shift_breaks_${fixedBreakIndex}_type" data-ha-equal="interval">
                            <input type="time" class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][interval_start]" placeholder="Interval Start" value="${extract(data, 'interval_start')}">
                            <input type="time" class="form-control" name="fixed_shift_breaks[${fixedBreakIndex}][interval_end]" placeholder="Interval End" value="${extract(data, 'interval_end')}">
                        </div>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-break" onclick="removeBreakRow(this)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `);

            fixedBreakIndex++;
            helper_attr_rev_init();
        }

        let shiftIndex = 0;

        function addShiftRow(data = {}) {
            jQuery('[xrole="shifts"]').append(`
                <tr xrole="shift-row" data-index="${shiftIndex}">
                    <td>
                        <input type="text" class="form-control" name="rotational_shift[${shiftIndex}][name]" value="${extract(data, 'name')}">
                    </td>
                    <td>
                        <input type="time" class="form-control" name="rotational_shift[${shiftIndex}][start_time]" onchange="calculateShiftDuration(this)" value="${extract(data, 'start_time')}">
                    </td>
                    <td>
                        <input type="time" class="form-control" name="rotational_shift[${shiftIndex}][end_time]" onchange="calculateShiftDuration(this)" value="${extract(data, 'end_time')}">
                    </td>
                    <td>
                        <div class="input-group">
                            <select class="form-control" name="rotational_shift[${shiftIndex}][hours]" onchange="calculateShiftDuration(this)">
                                <option value="">Hours</option>
                                @foreach (range(0, 23) as $hour)
                                <option value="{{ $hour }}" ${extract(data, 'hours') == '{{ $hour }}' ? 'selected' : ''}>{{ $hour }}</option>
                                @endforeach
                            </select>
                            <select class="form-control" name="rotational_shift[${shiftIndex}][minutes]" onchange="calculateShiftDuration(this)">
                                <option value="">Minutes</option>
                                @foreach (range(0, 59) as $minute)
                                <option value="{{ $minute }}" ${extract(data, 'minutes') == '{{ $minute }}' ? 'selected' : ''}>{{ $minute }}</option>
                                @endforeach
                            </select>
                        </div>
                    </td>
                    <td xrole="actual-shift-duration">
                        0h 0m
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-shift" onclick="removeShiftRow(this)"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `);

            shiftIndex++;
        }
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

        function calculateShiftDuration(initiator) {
            const row = initiator.closest('tr');
            const startTimeVal = row.querySelector('input[name*="[start_time]"]').value;
            const endTimeVal = row.querySelector('input[name*="[end_time]"]').value;
            const hoursSelect = row.querySelector('select[name*="[hours]"]');
            const minutesSelect = row.querySelector('select[name*="[minutes]"]');

            // Return early if times aren't set yet
            if (!startTimeVal || !endTimeVal) return;

            // Use a dummy date to compare times safely
            const baseDate = "1970-01-01 ";
            const start = new Date(baseDate + startTimeVal);
            let end = new Date(baseDate + endTimeVal);

            // Handle overnight shifts (e.g., 10 PM to 6 AM)
            if (end < start) {
                end.setDate(end.getDate() + 1);
            }

            let timeDiff = end - start;

            // Parse break values, defaulting to 0 if "Hours" or "Minutes" placeholder is selected
            const breakHours = parseInt(hoursSelect.value) || 0;
            const breakMinutes = parseInt(minutesSelect.value) || 0;
            const unpaidBreakMs = ((breakHours * 60) + breakMinutes) * 60 * 1000;

            const finalTimeDiff = timeDiff - unpaidBreakMs;

            // Ensure we don't show negative duration
            const displayMs = Math.max(0, finalTimeDiff);

            const displayHours = Math.floor(displayMs / (1000 * 60 * 60));
            const displayMinutes = Math.floor((displayMs % (1000 * 60 * 60)) / (1000 * 60));

            jQuery(row).find('td[xrole="actual-shift-duration"]').text(`${displayHours}h ${displayMinutes}m`);
        }

        function removeBreakRow(initiator){
            jQuery(initiator).parents('tr').remove();
        }

        function removeShiftRow(initiator){
            jQuery(initiator).parents('tr').remove();
        }

        function showError(message) {
            alert(message);
        }

        function validateShiftLogic() {
            const startTime = $('#fixed_shift_start_time').val();
            const endTime = $('#fixed_shift_end_time').val();

            if (!startTime || !endTime) return true; // Let HTML5 required handle empty fields

            const base = "1970-01-01 ";
            const shiftStart = new Date(base + startTime);
            let shiftEnd = new Date(base + endTime);
            if (shiftEnd < shiftStart) shiftEnd.setDate(shiftEnd.getDate() + 1);

            // 1. Validate Breaks
            let breakError = null;
            $('[data-role="break_row"]').each(function() {
                const type = $(this).find('select[name*="[type]"]').val();
                if (type === 'interval') {
                    const bStartVal = $(this).find('input[name*="[interval_start]"]').val();
                    const bEndVal = $(this).find('input[name*="[interval_end]"]').val();

                    if (bStartVal && bEndVal) {
                        let bStart = new Date(base + bStartVal);
                        let bEnd = new Date(base + bEndVal);

                        // Adjust for overnight break intervals
                        if (bStart < shiftStart && shiftEnd.getDate() > 1) bStart.setDate(bStart.getDate() + 1);
                        if (bEnd < bStart) bEnd.setDate(bEnd.getDate() + 1);

                        if (bStart < shiftStart || bEnd > shiftEnd) {
                            breakError =
                                `Break "${$(this).find('input[name*="[name]"]').val()}" must be within shift timing (${startTime} - ${endTime})`;
                            return false;
                        }
                    }
                }
            });

            if (breakError) {
                showError(breakError);
                return false;
            }

            // 2. Validate Buffers
            const punchIn = $('#fixed_shift_buffer_start').val();
            const punchOut = $('#fixed_shift_buffer_end').val();

            if (punchIn) {
                const pInDate = new Date(base + punchIn);
                if (pInDate > shiftStart) {
                    showError("Allowed Punch In Time should be before or equal to Shift Start Time.");
                    return false;
                }
            }

            if (punchOut) {
                let pOutDate = new Date(base + punchOut);
                if (pOutDate < shiftStart && shiftEnd.getDate() > 1) pOutDate.setDate(pOutDate.getDate() + 1);

                if (pOutDate < shiftEnd) {
                    showError("Allowed Punch Out Time should be after or equal to Shift End Time.");
                    return false;
                }
            }

            return true;
        }

        @foreach($template->fixedBreaks()->get() as $fixedBreak)
            @php
                $fixedBreak = $fixedBreak->toArray();
                $fixedBreak['hours'] = hour_minute($fixedBreak['hour_minute'], 'h');
                $fixedBreak['minutes'] = hour_minute($fixedBreak['hour_minute'], 'm');
            @endphp

            addFixedBreakRow(@json($fixedBreak))
        @endforeach

        @foreach($template->rotationalShifts()->get() as $rotationalShift)
            @php
                $rotationalShift = $rotationalShift->toArray();
                $rotationalShift['hours'] = hour_minute($rotationalShift['hour_minute'], 'h');
                $rotationalShift['minutes'] = hour_minute($rotationalShift['hour_minute'], 'm');
            @endphp
            
            addShiftRow(@json($rotationalShift))
        @endforeach

        document.querySelectorAll('.remove-shift').forEach((item) => calculateShiftDuration(item));
    </script>
@endpush
