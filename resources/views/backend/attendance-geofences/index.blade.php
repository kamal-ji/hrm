@extends('layouts.admin')

@section('content')
    <!-- Start Content -->
    <div class="content content-two">
        <div class="d-flex d-block align-items-center justify-content-between flex-wrap gap-3 mb-3">
            <div>
                <h6>📦 Attendance Geofence List</h6>
            </div>
            <div class="d-flex my-xl-auto right-content align-items-center flex-wrap gap-2">

                <div>
                    <a href="{{ route('attendance-geofence.create') }}" class="btn btn-primary d-flex align-items-center">
                        <i class="isax isax-add-circle5 me-1"></i> Add Attendance Geofence
                    </a>
                </div>
            </div>
        </div>

        <!-- Table List -->
        <div class="table-responsive">
            <table class="table table-nowrap datatable">
                <thead class="thead-light">
                    <tr>
                        <th class="no-sort">Name</th>
                        <th class="no-sort"></th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <!-- /Table List -->

    </div>
@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('.datatable').DataTable({
                "processing": true,
                "serverSide": true,
                "bFilter": true,
                "sDom": 'fBtlpi',
                "ordering": true,
                "paging": true,
                "pageLength": 50,
                "language": {
                    search: ' ',
                    sLengthMenu: '_MENU_',
                    searchPlaceholder: "Search",
                    sLengthMenu: 'Row Per Page _MENU_ Entries',
                    info: "_START_ - _END_ of _TOTAL_ items",
                    paginate: {
                        next: '<i class="isax isax-arrow-right-1"></i>',
                        previous: '<i class="isax isax-arrow-left"></i>'
                    },
                },
                "scrollX": false,
                "scrollCollapse": false,
                "responsive": false,
                "autoWidth": false,
                "columns": [
                    {
                        "data": "name",
                        "orderable": false
                    },
                    {
                        "data": "actions",
                        "orderable": false
                    }
                ],
                initComplete: function(settings, json) {
                    $('.dataTables_filter').appendTo('#tableSearch');
                    $('.dataTables_filter').appendTo('.search-input');
                },
                "ajax": {
                    "url": "{{ route('attendance-geofence.index') }}",
                    "type": "GET"
                }
            });
        });
    </script>
@endpush
