@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('automation-rule.index') }}"><i class="isax isax-arrow-left me-2"></i>Automation
                                Rule</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Edit Automation Rule</h5>
                            <form action="{{ route('automation-rule.update', $rule->id) }}" id="createForm"
                                enctype="multipart/form-data">

                                <div class="row gx-3">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Rule Name <span
                                                    class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{ $rule->name }}" required>
                                        </div>
                                        <br>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse"
                                                    href="#lateEntryRules" role="button" aria-expanded="false"
                                                    aria-controls="lateEntryRules">
                                                    Late Entry Rules
                                                </a>
                                            </div>

                                            <div id="lateEntryRules" class="collapse">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getLateEntryDeductions() as $item)
                                                    <div class="mb-3">
                                                        <label>
                                                            <input type="checkbox" class="late_entry_deduction_checkbox" name="late_entry_deductions[]" value="{{ $item['id'] }}" data-ha-name="late_entry_deductions" data-ha-container="#lateEntryRules" data-ha-callback="toggler" {{ $rule->{"late_entry_deductions_{$item['id']}"} ? 'checked' : '' }}> {{ $item['name'] }}
                                                        </label>
                                                        <div class="my-2" data-ha-relative="late_entry_deductions" data-ha-in="{{ $item['id'] }}" data-ha-selector=".late_entry_deduction_checkbox">
                                                            <div id="late_entry_deductions_{{ $item['id'] }}">

                                                            </div>
                                                            @if($item['id'] == 1)
                                                                <button type="button" class="btn btn-primary" onclick="addLateEntryDeductionRule()">Add Rule</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse"
                                                    href="#earlyExitRules" role="button" aria-expanded="false"
                                                    aria-controls="earlyExitRules">
                                                    Early Exit Rules
                                                </a>
                                            </div>

                                            <div id="earlyExitRules" class="collapse">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getEarlyExitDeductions() as $item)
                                                    <div class="mb-3">
                                                        <label>
                                                            <input type="checkbox" class="early_exit_deduction_checkbox" name="early_exit_deductions[]" value="{{ $item['id'] }}" data-ha-name="early_exit_deductions" data-ha-container="#earlyExitRules" data-ha-callback="toggler" {{ $rule->{"early_exit_deductions_{$item['id']}"} ? 'checked' : '' }}> {{ $item['name'] }}
                                                        </label>
                                                        <div class="my-2" data-ha-relative="early_exit_deductions" data-ha-in="{{ $item['id'] }}" data-ha-selector=".early_exit_deduction_checkbox">
                                                            <div id="early_exit_deductions_{{ $item['id'] }}">

                                                            </div>
                                                            @if($item['id'] == 1)
                                                                <button type="button" class="btn btn-primary" onclick="addEarlyExitDeductionRule()">Add Rule</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse"
                                                    href="#breaksRule" role="button" aria-expanded="false"
                                                    aria-controls="breaksRule">
                                                    Breaks Rule
                                                </a>
                                            </div>

                                            <div id="breaksRule" class="collapse">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getBreakDeductions() as $item)
                                                    <div class="mb-3">
                                                        <label>
                                                            <input type="checkbox" class="break_rule_checkbox" name="break_rules[]" value="{{ $item['id'] }}" data-ha-name="break_rules" data-ha-container="#breaksRule" data-ha-callback="toggler" {{ $rule->{"break_rules_{$item['id']}"} ? 'checked' : '' }}> {{ $item['name'] }}
                                                        </label>
                                                        <div class="my-2" data-ha-relative="break_rules" data-ha-in="{{ $item['id'] }}" data-ha-selector=".break_rule_checkbox">
                                                            <div id="break_rules_{{ $item['id'] }}">

                                                            </div>
                                                            @if($item['id'] == 1)
                                                                <button type="button" class="btn btn-primary" onclick="addBreakRule()">Add Rule</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse"
                                                    href="#overtimeRule" role="button" aria-expanded="false"
                                                    aria-controls="overtimeRule">
                                                    Overtime Rule
                                                </a>
                                            </div>

                                            <div id="overtimeRule" class="collapse">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getOvertimePayTypes() as $item)
                                                    <div class="mb-3">
                                                        <label>
                                                            <input type="checkbox" class="overtime_rule_checkbox" name="overtime_rules[]" value="{{ $item['id'] }}" data-ha-name="overtime_rules" data-ha-container="#overtimeRule" data-ha-callback="toggler" {{ $rule->{"overtime_rules_{$item['id']}"} ? 'checked' : '' }}> {{ $item['name'] }}
                                                        </label>
                                                        <div class="my-2" data-ha-relative="overtime_rules" data-ha-in="{{ $item['id'] }}" data-ha-selector=".overtime_rule_checkbox">
                                                            <div id="overtime_rules_{{ $item['id'] }}">

                                                            </div>
                                                            @if($item['id'] == 1)
                                                                <button type="button" class="btn btn-primary" onclick="addOvertimeRule()">Add Rule</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse"
                                                    href="#earlyOvertimeRule" role="button" aria-expanded="false"
                                                    aria-controls="earlyOvertimeRule">
                                                    Early Overtime Rule
                                                </a>
                                            </div>

                                            <div id="earlyOvertimeRule" class="collapse">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getEarlyOvertimePayTypes() as $item)
                                                    <div class="mb-3">
                                                        <label>
                                                            <input type="checkbox" class="early_overtime_rule_checkbox" name="early_overtime_rules[]" value="{{ $item['id'] }}" data-ha-name="early_overtime_rules" data-ha-container="#earlyOvertimeRule" data-ha-callback="toggler" {{ $rule->{"early_overtime_rules_{$item['id']}"} ? 'checked' : '' }}> {{ $item['name'] }}
                                                        </label>
                                                        <div class="my-2" data-ha-relative="early_overtime_rules" data-ha-in="{{ $item['id'] }}" data-ha-selector=".early_overtime_rule_checkbox">
                                                            <div id="early_overtime_rules_{{ $item['id'] }}">

                                                            </div>
                                                            @if($item['id'] == 1)
                                                                <button type="button" class="btn btn-primary" onclick="addEarlyOvertimeRule()">Add Rule</button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                </div>
                                            </div>
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
                    method: 'PUT',
                    data: formData,
                    processData: false, // Required for FormData
                    contentType: false, // Required for FormData
                    success: function(response) {
                        if (response.success) {
                            showSuccess(response.message ||
                                'Automation Rule created successfully');
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

        var lateEntryDeductionRule1Count = 0;
        var earlyExitDeductionRule1Count = 0;
        var breakRule1Count = 0;
        var overtimeRule1Count = 0;
        var earlyOvertimeRule1Count = 0;

        function addLateEntryDeductionRule(cx = 1, data = {}){
            jQuery('#late_entry_deductions_' + cx).append(`
                <div class="row mb-2" xrole="late-entry-deduction-rule-${cx}">
                    <div class="col-md-6">
                        <p class="mb-0">If Staff is Late by</p>
                        <div class="input-group">
                            <select class="form-control"
                                name="late_deduction_${cx}_rules_hours[${lateEntryDeductionRule1Count}][]">
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'hours') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>   
                            <select class="form-control"
                                name="late_deduction_${cx}_rules_minutes[${lateEntryDeductionRule1Count}][]">
                                <option value="">Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'minutes') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="input-group-text">hh:mm</span>
                        </div>
                        <small class="text-muted">No Early Exit Fine for 0 mins</small>
                    </div>
                    ${cx == 1 ? `<div class="col-md-2">
                        <p class="mb-0">Deduction Type</p>
                        <select class="form-control" name="late_deduction_${cx}_rules_type[${lateEntryDeductionRule1Count}][]">
                            @foreach(\App\Helpers\Constants::getDeductionAmountTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') === "{{ $type['id'] }}" ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <p class="mb-0">Deduction Amount</p>
                        <input type="number" class="form-control" min="0" step="0.01" name="late_deduction_${cx}_rules_amount[${lateEntryDeductionRule1Count}][]" placeholder="Amount" value="${extract(data, 'amount')}">
                    </div>
                    <div class="col-md-2">
                        <br>
                        ${
                            lateEntryDeductionRule1Count > 0 ? 
                                '<button type="button" class="btn btn-danger" onclick="removeLateEntryDeductionRule1(this)"><i class="fas fa-trash"></i></button>' : 
                                ''
                        }
                    </div>` : ''}
                </div>
            `);

            if(cx == 1) {
                lateEntryDeductionRule1Count++;
            }
        }

        function addEarlyExitDeductionRule(cx = 1, data = {}){
            jQuery('#early_exit_deductions_' + cx).append(`
                <div class="row mb-2" xrole="early-exit-deduction-rule-${cx}">
                    <div class="col-md-6">
                        <p class="mb-0">If Staff Leaves Early by</p>
                        <div class="input-group">
                            <select class="form-control"
                                name="early_exit_deduction_${cx}_rules_hours[${earlyExitDeductionRule1Count}][]">
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'hours') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>   
                            <select class="form-control"
                                name="early_exit_deduction_${cx}_rules_minutes[${earlyExitDeductionRule1Count}][]">
                                <option value="">Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'minutes') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="input-group-text">hh:mm</span>
                        </div>
                        <small class="text-muted">No Early Exit Fine for 0 mins</small>
                    </div>
                    ${cx == 1 ? `<div class="col-md-2">
                        <p class="mb-0">Deduction Type</p>
                        <select class="form-control" name="early_exit_deduction_${cx}_rules_type[${earlyExitDeductionRule1Count}][]">
                            @foreach(\App\Helpers\Constants::getDeductionAmountTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') === "{{ $type['id'] }}" ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <p class="mb-0">Deduction Amount</p>
                        <input type="number" class="form-control" min="0" step="0.01" name="early_exit_deduction_${cx}_rules_amount[${earlyExitDeductionRule1Count}][]" placeholder="Amount" value="${extract(data, 'amount')}">
                    </div>
                    <div class="col-md-2">
                        <br>
                        ${
                            earlyExitDeductionRule1Count > 0 ? 
                                '<button type="button" class="btn btn-danger" onclick="removeEarlyExitDeductionRule1(this)"><i class="fas fa-trash"></i></button>' : 
                                ''
                        }
                    </div>` : ''}
                </div>
            `);

            if(cx == 1) {
                earlyExitDeductionRule1Count++;
            }
        }

        function addBreakRule(cx = 1, data = {}){
            jQuery('#break_rules_' + cx).append(`
                <div class="row mb-2" xrole="break-rule-${cx}">
                    <div class="col-md-6">
                        <p class="mb-0">If Staff take breaks more than</p>
                        <div class="input-group">
                            <select class="form-control"
                                name="break_rule_${cx}_rules_hours[${breakRule1Count}][]">
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'hours') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>   
                            <select class="form-control"
                                name="break_rule_${cx}_rules_minutes[${breakRule1Count}][]">
                                <option value="">Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'minutes') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="input-group-text">hh:mm</span>
                        </div>
                        <small class="text-muted">No Break Fine for 0 mins</small>
                    </div>
                    ${cx == 1 ? `<div class="col-md-2">
                        <p class="mb-0">Deduction Type</p>
                        <select class="form-control" name="break_rule_${cx}_rules_type[${breakRule1Count}][]">
                            @foreach(\App\Helpers\Constants::getDeductionAmountTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') === "{{ $type['id'] }}" ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <p class="mb-0">Deduction Amount</p>
                        <input type="number" class="form-control" min="0" step="0.01" name="break_rule_${cx}_rules_amount[${breakRule1Count}][]" placeholder="Amount" value="${extract(data, 'amount')}">
                    </div>
                    <div class="col-md-2">
                        <br>
                        ${
                            breakRule1Count > 0 ? 
                                '<button type="button" class="btn btn-danger" onclick="removeBreakRule1(this)"><i class="fas fa-trash"></i></button>' : 
                                ''
                        }
                    </div>` : ''}
                </div>
            `);

            if(cx == 1) {
                breakRule1Count++;
            }
        }

        function addOvertimeRule(cx = 1, data = {}){
            jQuery('#overtime_rules_' + cx).append(`
                <div class="row mb-2" xrole="overtime-rule-${cx}">
                    <div class="col-md-6">
                        <p class="mb-0">If Staff is Late by</p>
                        <div class="input-group">
                            <select class="form-control"
                                name="overtime_rule_${cx}_rules_hours[${overtimeRule1Count}][]">
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'hours') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>   
                            <select class="form-control"
                                name="overtime_rule_${cx}_rules_minutes[${overtimeRule1Count}][]">
                                <option value="">Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'minutes') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="input-group-text">hh:mm</span>
                        </div>
                        <small class="text-muted">No Early Exit Fine for 0 mins</small>
                    </div>
                    ${cx == 1 ? `<div class="col-md-2">
                        <p class="mb-0">Deduction Type</p>
                        <select class="form-control" name="overtime_rule_${cx}_rules_type[${overtimeRule1Count}][]">
                            @foreach(\App\Helpers\Constants::getDeductionAmountTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') === "{{ $type['id'] }}" ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <p class="mb-0">Deduction Amount</p>
                        <input type="number" class="form-control" min="0" step="0.01" name="overtime_rule_${cx}_rules_amount[${overtimeRule1Count}][]" placeholder="Amount" value="${extract(data, 'amount')}">
                    </div>
                    <div class="col-md-2">
                        <br>
                        ${
                            overtimeRule1Count > 0 ? 
                                '<button type="button" class="btn btn-danger" onclick="removeOvertimeRule1(this)"><i class="fas fa-trash"></i></button>' : 
                                ''
                        }
                    </div>` : ''}
                </div>
            `);

            if(cx == 1) {
                overtimeRule1Count++;
            }
        }

        function addEarlyOvertimeRule(cx = 1, data = {}){
            jQuery('#early_overtime_rules_' + cx).append(`
                <div class="row mb-2" xrole="early-overtime-rule-${cx}">
                    <div class="col-md-6">
                        <p class="mb-0">If Staff is Early by</p>
                        <div class="input-group">
                            <select class="form-control"
                                name="early_overtime_rule_${cx}_rules_hours[${earlyOvertimeRule1Count}][]">
                                <option value="">Hours</option>
                                @for ($i = 0; $i < 24; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'hours') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>   
                            <select class="form-control"
                                name="early_overtime_rule_${cx}_rules_minutes[${earlyOvertimeRule1Count}][]">
                                <option value="">Minutes</option>
                                @for ($i = 0; $i < 60; $i++)
                                    <option value="{{ $i }}" ${extract(data, 'minutes') === "{{ $i }}" ? 'selected' : ''}>
                                        {{ $i }}
                                    </option>
                                @endfor
                            </select>
                            <span class="input-group-text">hh:mm</span>
                        </div>
                        <small class="text-muted">No Early Exit Fine for 0 mins</small>
                    </div>
                    ${cx == 1 ? `<div class="col-md-2">
                        <p class="mb-0">Deduction Type</p>
                        <select class="form-control" name="early_overtime_rule_${cx}_rules_type[${earlyOvertimeRule1Count}][]">
                            @foreach(\App\Helpers\Constants::getDeductionAmountTypes() as $type)
                                <option value="{{ $type['id'] }}" ${extract(data, 'type') === "{{ $type['id'] }}" ? 'selected' : ''}>{{ $type['name'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <p class="mb-0">Deduction Amount</p>
                        <input type="number" class="form-control" min="0" step="0.01" name="early_overtime_rule_${cx}_rules_amount[${earlyOvertimeRule1Count}][]" placeholder="Amount" value="${extract(data, 'amount')}">
                    </div>
                    <div class="col-md-2">
                        <br>
                        ${
                            earlyOvertimeRule1Count > 0 ? 
                                '<button type="button" class="btn btn-danger" onclick="removeEarlyOvertimeRule1(this)"><i class="fas fa-trash"></i></button>' : 
                                ''
                        }
                    </div>` : ''}
                </div>
            `);

            if(cx == 1) {
                earlyOvertimeRule1Count++;
            }
        }

        function removeLateEntryDeductionRule1(button) {
            $(button).closest('[xrole="late-entry-deduction-rule-1"]').remove();
        }

        function removeEarlyExitDeductionRule1(button) {
            $(button).closest('[xrole="early-exit-deduction-rule-1"]').remove();
        }

        function removeBreakRule1(button) {
            $(button).closest('[xrole="break-rule-1"]').remove();
        }

        function removeOvertimeRule1(button) {
            $(button).closest('[xrole="overtime-rule-1"]').remove();
        }

        function removeEarlyOvertimeRule1(button) {
            $(button).closest('[xrole="early-overtime-rule-1"]').remove();
        }

        function extract(payload, dataToExtract){
            if(!payload){
                return '';
            }

            if(dataToExtract in payload){
                return payload[dataToExtract];
            }

            return '';
        }

        document.addEventListener('DOMContentLoaded', function() {
            @foreach($formattedRules['late_entry_deductions_3'] ?? [] as $rule)
                addLateEntryDeductionRule(3, @json($rule));
            @endforeach

            @if(count($formattedRules['late_entry_deductions_3'] ?? []) == 0)
                addLateEntryDeductionRule(3);
            @endif
            
            @foreach($formattedRules['late_entry_deductions_2'] ?? [] as $rule)
                addLateEntryDeductionRule(2, @json($rule));
            @endforeach

            @if(count($formattedRules['late_entry_deductions_2'] ?? []) == 0)
                addLateEntryDeductionRule(2);
            @endif

            @foreach($formattedRules['late_entry_deductions_1'] ?? [] as $rule)
                addLateEntryDeductionRule(1, @json($rule));
            @endforeach

            @if(count($formattedRules['late_entry_deductions_1'] ?? []) == 0)
                addLateEntryDeductionRule(1);
            @endif

            @foreach($formattedRules['early_exit_deductions_3'] ?? [] as $rule)
                addEarlyExitDeductionRule(3, @json($rule));
            @endforeach

            @if(count($formattedRules['early_exit_deductions_3'] ?? []) == 0)
                addEarlyExitDeductionRule(3);
            @endif
            
            @foreach($formattedRules['early_exit_deductions_2'] ?? [] as $rule)
                addEarlyExitDeductionRule(2, @json($rule));
            @endforeach

            @if(count($formattedRules['early_exit_deductions_2'] ?? []) == 0)
                addEarlyExitDeductionRule(2);
            @endif

            @foreach($formattedRules['early_exit_deductions_1'] ?? [] as $rule)
                addEarlyExitDeductionRule(1, @json($rule));
            @endforeach

            @if(count($formattedRules['early_exit_deductions_1'] ?? []) == 0)
                addEarlyExitDeductionRule(1);
            @endif

            @foreach($formattedRules['break_rules_3'] ?? [] as $rule)
                addBreakRule(3, @json($rule));
            @endforeach

            @if(count($formattedRules['break_rules_3'] ?? []) == 0)
                addBreakRule(3);
            @endif
            
            @foreach($formattedRules['break_rules_2'] ?? [] as $rule)
                addBreakRule(2, @json($rule));
            @endforeach

            @if(count($formattedRules['break_rules_2'] ?? []) == 0)
                addBreakRule(2);
            @endif

            @foreach($formattedRules['break_rules_1'] ?? [] as $rule)
                addBreakRule(1, @json($rule));
            @endforeach

            @if(count($formattedRules['break_rules_1'] ?? []) == 0)
                addBreakRule(1);
            @endif

            @foreach($formattedRules['overtime_rules_3'] ?? [] as $rule)
                addOvertimeRule(3, @json($rule));
            @endforeach

            @if(count($formattedRules['overtime_rules_3'] ?? []) == 0)
                addOvertimeRule(3);
            @endif
            
            @foreach($formattedRules['overtime_rules_2'] ?? [] as $rule)
                addOvertimeRule(2, @json($rule));
            @endforeach

            @if(count($formattedRules['overtime_rules_2'] ?? []) == 0)
                addOvertimeRule(2);
            @endif

            @foreach($formattedRules['overtime_rules_1'] ?? [] as $rule)
                addOvertimeRule(1, @json($rule));
            @endforeach

            @if(count($formattedRules['overtime_rules_1'] ?? []) == 0)
                addOvertimeRule(1);
            @endif

            @foreach($formattedRules['early_overtime_rules_3'] ?? [] as $rule)
                addEarlyOvertimeRule(3, @json($rule));
            @endforeach

            @if(count($formattedRules['early_overtime_rules_3'] ?? []) == 0)
                addEarlyOvertimeRule(3);
            @endif
            
            @foreach($formattedRules['early_overtime_rules_2'] ?? [] as $rule)
                addEarlyOvertimeRule(2, @json($rule));
            @endforeach

            @if(count($formattedRules['early_overtime_rules_2'] ?? []) == 0)
                addEarlyOvertimeRule(2);
            @endif

            @foreach($formattedRules['early_overtime_rules_1'] ?? [] as $rule)
                addEarlyOvertimeRule(1, @json($rule));
            @endforeach

            @if(count($formattedRules['early_overtime_rules_1'] ?? []) == 0)
                addEarlyOvertimeRule(1);
            @endif
        });
    </script>
@endpush
