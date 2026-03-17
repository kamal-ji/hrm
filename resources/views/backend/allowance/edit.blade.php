@extends('layouts.admin')

@section('content')
<div class="content">

    <div class="row">
        <div class="col-md-10 mx-auto">
            <div>

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <h6>
                        <a href="{{ route('allowance.index') }}">
                            <i class="isax isax-arrow-left me-2"></i> Allowance
                        </a>
                    </h6>
                </div>

                <div class="card">
                    <div class="card-body">

                        <h5 class="mb-3">Update Allowance</h5>

                        <form action="{{ route('allowance.update',$allowance->id) }}" method="post" id="createForm" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Allowance Name *</label>
                                        <input type="text" class="form-control" name="name" value="{{ $allowance->name }}">
                                    </div>
                                </div>
                                
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <label class="form-label">Status</label>
                                        <select class="form-control" name="is_active">
                                            <option value="1" {{ $allowance->is_active == 1 ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ $allowance->is_active == 0 ? 'selected' : '' }}>Inactive</option>
                                        </select>
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
                                'Allowance updated successfully');
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
