{{--Users Index--}}
@extends('crud::layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <a href="{{route('users.create')}}" type="button" class="btn btn-primary text-white me-0" style="float: right">
                Add User
            </a>
            <br>
            <h3 class="card-title">Users Management</h3>
            <div class="table-responsive">
                <table class="table table-hover">
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
                    @foreach($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->email}}</td>
                            @if($data->is_super_user)
                                <td><label
                                        class="badge badge-success">{{$data->convertTrueFalse($data->is_super_user) }}</label>
                                </td>
                            @else
                                <td><label
                                        class="badge badge-danger">{{$data->convertTrueFalse($data->is_super_user) }}</label>
                                </td>
                            @endif

                            @if($data->is_active)
                                <td><label
                                        class="badge badge-success">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @else
                                <td><label
                                        class="badge badge-danger">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @endif

                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <a href="{{route('users.edit', ['user' => $data->id])}}" type="button" class="btn btn-primary text-white">Edit </a>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('crud::admin.users.actions.delete-users')
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


