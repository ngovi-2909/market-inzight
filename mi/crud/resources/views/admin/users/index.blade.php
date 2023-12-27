{{--Users Index--}}
@extends('crud::layouts.master')
@push('css')
    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('users.create')}}" type="button" class="btn btn-primary text-white me-0" style="float: right">
                Add User
            </a>
            <br>
            <h3 class="card-title">Users Management</h3>
            <div class="table-responsive">
                <table class="table table-hover" id="users-table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Email</th>
                        <th>Is Super User</th>
                        <th>Is Active</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.js"></script>

    <script>
        var table = $('#users-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            order: [],
            buttons: [
                {
                    extend: 'pdf',
                    title: 'users',
                    exportOptions: {
                        columns: ':visible :not(.not-export)'
                    }
                },
                {
                    extend: 'excel',
                    title: 'users',
                    exportOptions: {
                        columns: ':visible :not(.not-export)',
                    }
                }
            ],
            ajax: '{!!! route('users.api') !!}',
            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 4, 5, 6],
                },
                {className: "not-export", "targets": [6]}
            ],
            columns: [
                {data: 'DT_RowIndex', targets: 0},
                {data: 'email', name: 'email', targets: 1},
                {data: 'is_super_user', name: 'is_super_user', targets: 2},
                {data: 'is_active', name: 'is_active', targets: 3},
                {data: 'created_at', name: 'created_at', targets: 4},
                {data: 'updated_at', name: 'updated_at', targets: 5},
                {data: 'action', name: 'action', targets: 6},
            ]

        });


    </script>
@endpush
