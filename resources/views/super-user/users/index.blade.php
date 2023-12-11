{{--Users Index--}}
@extends('layouts.master')
@section('content')
    @include('super-user.users.actions.add-users')
    <div class="card">
        <div class="card-body">

            <button class="btn btn-primary text-white me-0" style="float: right" data-toggle="modal"
                    data-target="#addUserModel">
                Add User
            </button>
            <br>
            <h3 class="card-title">Users Management</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>first_name</th>
                        <th>last_name</th>
                        <th>email</th>
                        <th>is_super_user</th>
                        <th>is_active</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->first_name}}</td>
                            <td>{{$data->last_name}}</td>
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
                                <button type="button" data-toggle="modal" data-target="#edit{{$data->id}}"
                                        class="btn btn-primary text-white">Edit
                                </button>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('super-user.users.actions.edit-users')
                                @include('super-user.users.actions.delete-users')
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('users')
    <script>
        function clearMessage(first_name, last_name, password, phone){
            first_name.innerHTML = "";
            last_name.innerHTML = "";
            password.innerHTML = "";
            phone.innerHTML = "";
        }
        function validateUsers(id) {

            if(!Number.isInteger(id)){
                id = "";
            }

            const first_name = document.getElementById('first_name_' + id);
            const last_name = document.getElementById('last_name_' + id);
            const password = document.getElementById('password_' + id);
            const phone = document.getElementById('phone_' + id);

            const first_name_message = document.getElementById('first_name_message_' + id);
            const last_name_message = document.getElementById('last_name_message_' + id);
            const password_message = document.getElementById('password_message_' + id);
            const phone_message = document.getElementById('phone_message_' + id);

            if ((first_name.value.length < 3) || (first_name.value.length > 255)) {
                clearMessage(first_name_message, last_name_message, password_message, phone_message);
                first_name_message.innerHTML = "The first name must be at least 3 and less than 255 character";
                return false;
            } else if ((last_name.value.length < 3) || (last_name.value.length > 255)) {
                clearMessage(first_name_message, last_name_message, password_message, phone_message);
                last_name_message.innerHTML = "The last name must be at least 3 and less than 255 character";
                return false;
            } else if (password.value.length < 3) {
                clearMessage(first_name_message, last_name_message, password_message, phone_message);
                password_message.innerHTML = "The password must be at least 3 characters";
                return false;
            } else if (phone.value.length < 10) {
                clearMessage(first_name_message, last_name_message, password_message, phone_message);
                phone_message.innerHTML = "Phone must be at least 10 numbers";
                return false;
            }
            return true;
        }
    </script>
@endsection

