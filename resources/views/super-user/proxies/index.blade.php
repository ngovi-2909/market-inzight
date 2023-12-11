{{--Proxies Index--}}
@php use App\Repositories\UserRepository; @endphp
@extends('layouts.master')
@section('content')
    @include('super-user.proxies.actions.add-proxies')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary text-white me-0" style="float: right" data-toggle="modal"
                    data-target="#addProxyModal">
                Add Proxies
            </button>
            <br>
            <h3 class="card-title">Proxies Management</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>host</th>
                        <th>port</th>
                        <th>is_active</th>
                        <th>created_by</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->host}}</td>
                            <td>{{$data->port}}</td>
                            @if($data->is_active)
                                <td><label
                                        class="badge badge-success">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @else
                                <td><label
                                        class="badge badge-danger">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @endif
                            <td>{{UserRepository::getUserMailByID($data->created_by)}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#edit{{$data->id}}"
                                        class="btn btn-primary text-white">Edit
                                </button>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('super-user.proxies.actions.edit-proxies')
                                @include('super-user.proxies.actions.delete-proxies')
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('proxies')
    <script>
        function proxies_validate(id) {
            if(!Number.isInteger(id)){
                id = "";
            }
            const host = document.getElementById("host_" + id);
            const port = document.getElementById("port_" + id);


            const host_message = document.getElementById("host_message_" + id);
            const port_message = document.getElementById("port_message_" + id);
            if (host.value.length <= 0) {
                host_message.innerHTML = "Host is required";
                return false;
            } else if (port.value < 0 || port.value > 64738) {
                host_message.innerHTML = "";
                port_message.innerHTML = "Port in range from 0 to 64738";
                return false;
            } else if (port.value.length <= 0) {
                host_message.innerHTML = "";
                port_message.innerHTML = "Port is required";
                return false;
            } else {
                host_message.innerHTML = "";
                port_message.innerHTML = "";
                return true;
            }
        }
    </script>
@endsection

