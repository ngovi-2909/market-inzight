{{--Emails Index--}}
@php use mi\crud\Repositories\UserRepository; @endphp
@extends('crud::layouts.master')
{{--@push('css')--}}
{{--    <link href="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.css" rel="stylesheet">--}}
{{--@endpush--}}
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
                    <option value="{{route('emails.export')}}">Export email</option>
                    <option value="#" id="deleteAll">Delete selected</option>
                </select>
            </div>


{{--            <a href="{{route('emails.importEmail')}}" class="btn btn-success btn-rounded btn-fw text-white me-0" style="float: right">--}}
{{--                Import--}}
{{--            </a>--}}
{{--            <a href="{{route('emails.create')}}" class="btn btn-primary btn-rounded btn-fw text-white me-0" style="float: right">--}}
{{--                Add Email--}}
{{--            </a>--}}


            <br>
            <h3 class="card-title">Emails IP Management</h3>
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
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr id="email_id_{{$data->id}}">
                            <td>
                                <input type="checkbox" name="ids" value="{{$data->id}}">
                            </td>
                            @if(auth()->user()->is_super_user)
                                <td>{{$data->id}}</td>
                            @else
                                <td>{{ $loop->iteration + (($datas->currentPage() - 1) * $datas->perPage()) }}</td>
                            @endif
                            <td>{{$data->email}}</td>

                            <td>
                                @if(!empty($data->status))
                                    <label
                                        @if(strtolower($data->status) == 'public')
                                            class="badge badge-success"
                                        @elseif(strtolower($data->status) == 'pending')
                                            class="badge badge-warning"
                                        @else
                                            class="badge badge-danger"
                                        @endif
                                    >{{$data->status }}</label>
                                @else
                                    <label class="badge badge-primary">
                                        none
                                    </label>
                                @endif

                            </td>
                            <td>
                                @if(!empty($data->blocked_in) && ($data->blocked_in != 'None'))
                                    <label class="badge badge-info">
                                        {{$data->blocked_in}}
                                    </label>
                                @else
                                    <label class="badge badge-primary">
                                       none
                                    </label>
                                @endif
                                </td>
                            <td>{{$data->expired_time}}</td>
                            <td>{{UserRepository::getUserMailByID($data->created_by)}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <a href="{{route('emails.edit', ['email'=>$data->id])}}" type="button" class="btn btn-primary text-white">Edit</a>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('crud::admin.emails.actions.delete-emails')
                            </td>

                        </tr>

                    @endforeach


                    </tbody>
                </table>
                {{$datas->links()}}
            </div>

        </div>
    </div>
@endsection
{{--@push('js')--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/v/bs4/jszip-3.10.1/dt-1.13.8/b-2.4.2/b-html5-2.4.2/b-print-2.4.2/date-1.5.1/fc-4.3.0/fh-3.4.0/r-2.5.0/rg-1.4.1/sc-2.3.0/sb-1.6.0/sl-1.7.0/datatables.min.js"></script>--}}

{{--    <script>--}}
{{--        $('#emails-table').DataTable({--}}
{{--            dom: 'Bfrtip',--}}
{{--            processing: true,--}}
{{--            serverSide: true,--}}
{{--            select: true,--}}
{{--            buttons: [--}}
{{--                {--}}
{{--                    extend: 'pdf',--}}
{{--                    exportOptions: {--}}
{{--                        columns: ':visible :not(.not-export)'--}}
{{--                    }--}}
{{--                }--}}
{{--            ],--}}
{{--            ajax: '{!!! route('emails.api') !!}',--}}
{{--            columnDefs: [--}}
{{--                {className: "not-export", "targets": [8]}--}}
{{--            ],--}}
{{--            columns: [--}}
{{--                {data: 'id', name: 'id'},--}}
{{--                {data: 'email', name: 'email', orderable: false},--}}
{{--                {data: 'status', name: 'status', orderable: false},--}}
{{--                {data: 'blocked_place', name: 'blocked_place', orderable: false},--}}
{{--                {data: 'expired_time', name: 'expired_time', orderable: false},--}}
{{--                {data: 'created_by', name: 'created_by', orderable: false},--}}
{{--                {data: 'created_at', name: 'created_at', orderable: false},--}}
{{--                {data: 'updated_at', name: 'updated_at', orderable: false},--}}
{{--                {--}}
{{--                    data:'edit',--}}
{{--                    targets: 8,--}}
{{--                    orderable: false,--}}
{{--                    searchable: false,--}}
{{--                    render: function(data, type, row, meta){--}}
{{--                        return `<a href="${data}" type="button" class="btn btn-primary text-white">Edit</a>`--}}
{{--                    }--}}
{{--                }--}}
{{--            ]--}}
{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}

@section('select-all')
<script>
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
                            $('#email_id_'+val).remove();
                            // $('.table').load(location.href + " .table");
                            location.reload();
                        })
                    }
                });
            }
        });

    });

</script>
@endsection
