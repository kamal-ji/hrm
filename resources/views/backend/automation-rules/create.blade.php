@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content">

        <!-- start row -->
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h6><a href="{{ route('automation-rule.index') }}"><i class="isax isax-arrow-left me-2"></i>Automation Rule</a>
                        </h6>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="mb-3">Add Automation Rule</h5>
                            <form action="{{ route('automation-rule.store') }}" id="createForm" enctype="multipart/form-data">
                                
                                <div class="row gx-3">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="mb-2">
                                            <label class="form-label">Rule Name <span class="text-danger ms-1">*</span></label>
                                            <input type="text" class="form-control" name="name" id="name" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <a class="text-decoration-none d-block" data-bs-toggle="collapse" href="#lateEntryRules" role="button" aria-expanded="true" aria-controls="lateEntryRules">
                                                    Late Entry Rules
                                                </a>
                                            </div>

                                            <div id="lateEntryRules" class="collapse show">
                                                <div class="card-body">
                                                    @foreach(\App\Helpers\Constants::getLateEntryDeductions() as $item)
                                                    <div>
                                                        <label>
                                                            <input type="checkbox" name="late_deduction_rules[]" value="{{ $item['id'] }}"> {{ $item['name'] }}
                                                        </label>
                                                        <div data-ha-relative="late_deduction_rules[]" data-ha-in="{{ $item['id'] }}">
                                                            <div class="">

                                                            </div>
                                                        </div>
                                                    </div>
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
                    method: 'POST',
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
    </script>
@endpush
