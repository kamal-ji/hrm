@extends('layouts.admin')

@section('content')
<div class="content">

    <!-- Page Header -->
    <div class="row">
        <div class="col-md-10 mx-auto">
            <div class="d-flex align-items-center justify-content-between mb-3">
                <h6>Attendance Modes</h6>
                <button class="btn btn-sm btn-success" id="addModeBtn">Add Mode</button>
            </div>

            <!-- DataTable -->
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-bordered table-striped" id="attendanceModesTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Model Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: Add / Edit -->
    <div class="modal fade" id="attendanceModeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="attendanceModeForm">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Attendance Mode</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">

                        <input type="hidden" name="mode_id" id="mode_id">

                        <div class="form-group mb-2">
                            <label for="model_name">Mode Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="model_name" id="model_name" required>
                        </div>

                        <div class="form-group mb-2">
                            <label for="is_active">Status</label>
                            <select class="form-control" name="is_active" id="is_active">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary submitBtn">Save</button>
                        <div class="spinner-border spinner-border-sm d-none loadingSpinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
$(document).ready(function(){

    $.ajaxSetup({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
    });

    // Initialize DataTable
    var table = $('#attendanceModesTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('attendance-modes.index') }}",
        columns: [
            { data: 'id', name: 'id' },
            { data: 'model_name', name: 'model_name' },
            { data: 'status', name: 'status' },
            { data: 'actions', name: 'actions', orderable: false, searchable: false }
        ]
    });

    // Open Add Modal
    $('#addModeBtn').click(function(){
        $('#attendanceModeForm')[0].reset();
        $('#mode_id').val('');
        $('#attendanceModeModal .modal-title').text('Add Attendance Mode');
        $('.form-error').remove();
        $('#attendanceModeModal').modal('show');
    });

    // Submit Add / Update
    $('#attendanceModeForm').on('submit', function(e){
        e.preventDefault();

        let modeId = $('#mode_id').val();
        let url = modeId ? '/attendance-modes/' + modeId : "{{ route('attendance-modes.store') }}";
        let method = modeId ? 'PUT' : 'POST';

        $('.submitBtn').prop('disabled', true);
        $('.loadingSpinner').removeClass('d-none');

        $.ajax({
            url: url,
            method: method,
            data: $(this).serialize(),
            success: function(response){
                if(response.success){
                    $('#attendanceModeModal').modal('hide');
                    showSuccess(response.message || 'Saved successfully');
                    table.ajax.reload();
                } else {
                    showError(response.message || 'Something went wrong');
                }
            },
            error: function(xhr){
                $('.form-error').remove();
                if(xhr.responseJSON && xhr.responseJSON.errors){
                    for(let field in xhr.responseJSON.errors){
                        let errorMsg = xhr.responseJSON.errors[field][0];
                        let fieldElement = $('[name="'+field+'"]');
                        $('<div class="form-error text-danger mt-1"></div>').text(errorMsg).insertAfter(fieldElement);
                    }
                } else {
                    showError('An error occurred');
                }
            },
            complete: function(){
                $('.submitBtn').prop('disabled', false);
                $('.loadingSpinner').addClass('d-none');
            }
        });
    });

    // Edit Mode
    $(document).on('click', '.editBtn', function(){
        let modeId = $(this).data('id');

        $.get('/attendance-modes/' + modeId + '/edit', function(response){
            if(response.success){
                let data = response.data;
                $('#mode_id').val(data.id);
                $('#model_name').val(data.model_name);
                $('#is_active').val(data.is_active ? 1 : 0);

                $('#attendanceModeModal .modal-title').text('Edit Attendance Mode');
                $('.form-error').remove();
                $('#attendanceModeModal').modal('show');
            }
        });
    });

    // Delete Mode
    $(document).on('click', '.deleteBtn', function(){
        let modeId = $(this).data('id');
        if(confirm('Are you sure you want to delete this mode?')){
            $.ajax({
                url: '/attendance-modes/' + modeId,
                type: 'DELETE',
                success: function(response){
                    if(response.success){
                        showSuccess(response.message || 'Deleted successfully');
                        table.ajax.reload();
                    } else {
                        showError(response.message || 'Delete failed');
                    }
                }
            });
        }
    });

});
</script>
@endpush