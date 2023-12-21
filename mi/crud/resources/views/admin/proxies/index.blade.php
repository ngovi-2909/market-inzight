{{--Proxies Index--}}
@php use mi\crud\Repositories\UserRepository; @endphp
@extends('crud::layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="row" style="float:right;">
                <select style="width: min-content" class="form-select" id="actions" name="actions"
                        onchange="location = this.value;"
                >
                    <option value="{{route('proxies.index')}}">Choose actions</option>
                    <option value="{{route('proxies.create')}}">Add proxy</option>
                    <option value="{{route('proxies.importProxy')}}">Import proxy</option>
                    <option value="{{route('proxies.export')}}">Export proxy</option>
                    <option value="#" id="deleteAll">Delete selected</option>
                </select>
            </div>

{{--            <a href="{{route('proxies.importProxy')}}" class="btn btn-success btn-rounded btn-fw text-white me-0" style="float: right">--}}
{{--                Import--}}
{{--            </a>--}}
{{--            <a href="{{route('proxies.create')}}" class="btn btn-primary btn-rounded btn-fw text-white me-0" style="float: right">--}}
{{--                Add Proxies--}}
{{--            </a>--}}

            <br>
            <h3 class="card-title">Proxies IP Management</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>
                            <input type="checkbox" id="select-all">
                        </th>
                        <th>#</th>
                        <th>Host</th>
                        <th>Port</th>
                        <th>Username</th>
                        <th>Status</th>
                        <th>Blocked In</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr id="proxy_id_{{$data->id}}">
                            <td>
                                <input type="checkbox" name="ids" value="{{$data->id}}">
                            </td>
                            @if(auth()->user()->is_super_user)
                                <td>{{$data->id}}</td>
                            @else
                                <td>{{ $loop->iteration + (($datas->currentPage() - 1) * $datas->perPage()) }}</td>
                            @endif

                            <td>{{$data->host}}</td>
                            <td>{{$data->port}}</td>
                            <td>{{$data->username}}</td>

                            <td>
                                @if(!empty($data->status))
                                    <label
                                        @if(strtolower( $data->status) ==  'public')
                                            class="badge badge-success"
                                        @elseif((strtolower($data->status) == 'pending'))
                                            class="badge badge-warning"
                                        @else
                                            class="badge badge-danger"
                                        @endif
                                    >{{$data->status}}</label>
                                @else
                                    <label class="badge badge-primary">
                                        none
                                    </label>
                                @endif

                            </td>

                            <td>
                                @if(!empty($data->blocked_in))
                                    <label class="badge badge-info">
                                        {{$data->blocked_in}}
                                    </label>
                                @else
                                    <label class="badge badge-primary">
                                        none
                                    </label>
                                @endif
                            </td>

                            <td>{{UserRepository::getUserMailByID($data->created_by)}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <a href="{{route('proxies.edit', ['proxy'=>$data->id])}}" type="button"
                                        class="btn btn-primary text-white">Edit
                                </a>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('crud::admin.proxies.actions.delete-proxies')
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
                        url:"{{route('proxies.deleteAll')}}",
                        type: "DELETE",
                        data:{
                            ids: all_ids,
                            _token: '{{csrf_token()}}',
                        },
                        success:function (response){
                            $.each(all_ids, function(key,val){
                                $('#select-all').prop('checked', '');
                                $('#proxy_id_'+val).remove();
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
