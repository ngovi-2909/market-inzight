{{--Emails Index--}}
@php use mi\crud\Repositories\UserRepository; @endphp
@extends('crud::layouts.master')
@push('css')
    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row" style="float:right;">
                <select style="width: min-content" class="form-select" id="actions" name="actions"
                    onchange="location = this.value;"
                >
                    <option value="{{route('emails.index')}}">Choose actions</option>
                    <option value="{{route('emails.create')}}">Add email</option>
                    <option value="{{route('emails.importEmail')}}">Import email</option>
                    <option value="#" id="deleteAll">Delete selected</option>
                </select>
            </div>
            <br>
            @if($errors->any())
                @foreach ($errors->all() as $error)
                    <div>
                        <span class="alert alert-danger">{{ $error }}</span>
                    </div>
                @endforeach
            @endif
            <br>

            <h3 class="card-title">Emails IP Management</h3>
            <div id="alertMessage" class="alert alert-success" style="display: none"> You have successfully deleted data. </div>
            <div class="table-responsive">
                <table class="table table-hover" id="emails-table">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>#</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Blocked In</th>
                        <th>Expired Time</th>
                        <th>Created By</th>
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

        var table = $('#emails-table').DataTable({
            dom: 'Bfrtip',
            processing: true,
            serverSide: true,
            order: [],
            buttons: [
                {
                    extend: 'pdf',
                    title: 'emails_ip',
                    exportOptions: {
                        columns: ':visible :not(.not-export)'
                    }
                },
                {
                    extend: 'excel',
                    title: 'emails_ip',
                    exportOptions: {
                        columns: ':visible :not(.not-export)'
                    }
                }
            ],
            ajax: '{!!! route('emails.api') !!}',
            columnDefs: [
                {
                    orderable: false,
                    targets: [0, 1, 6, 7, 8, 9]
                },
                {className: "not-export", "targets": [9]}
            ],
            columns: [
                {data: 'checkbox', name: 'checkbox', targets: 0},
                {data: 'DT_RowIndex', targets: 1},
                {data: 'email', name: 'email', targets: 2},
                {data: 'status', name: 'status', targets: 3},
                {data: 'blocked_in', name: 'blocked_in', targets: 4},
                {data: 'expired_time', name: 'expired_time', targets: 5},
                {data: 'created_by', name: 'created_by', targets: 6},
                {data: 'created_at', name: 'created_at', targets: 7},
                {data: 'updated_at', name: 'updated_at', targets: 8},
                {data: 'action', name: 'action', targets: 9},
            ]
        });

        $(function(e){

            $('#select-all').click(function event(){
                $(':checkbox').prop('checked', this.checked);
            });

            $('#actions').click(function (e){
                var value = $('#actions').find(":selected").val();
                if(value === '#'){
                    e.preventDefault();
                    var all_ids = [];

                    $('input:checkbox[name=ids]:checked').each(function(){
                        all_ids.push($(this).val());
                    });

                    $.ajax({
                        url:"{{route('emails.deleteAll')}}",
                        type: "DELETE",
                        data:{
                            ids: all_ids,
                            _token: '{{csrf_token()}}',
                        },
                        success:function (response){
                            $.each(all_ids, function(key,val){
                                $('#select-all').prop('checked', '');
                                // $('#email_id_'+val).remove();
                                // $('.table').load(location.href + " .table");
                                // location.reload();
                                $('#alertMessage').show();
                                setTimeout(function (){
                                    $('#alertMessage').fadeOut();
                                }, 2000);
                                $('#actions').prop('selectedIndex', 0);
                                table.ajax.reload();
                            })

                        }

                    });
                }
            });
        });

    </script>

@endpush

