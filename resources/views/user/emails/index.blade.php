{{--Emails Index--}}
@extends('layouts.master')
@section('content')
    @include('user.emails.actions.add-emails')
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary text-white me-0" style="float: right" data-toggle="modal"
                    data-target="#addEmailModal">
                Add Email
            </button>
            <br>
            <h3 class="card-title">Emails Management</h3>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>email</th>
                        <th>is_active</th>
                        <th>expired_time</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{$data->email}}</td>
                            @if($data->is_active)
                                <td><label
                                        class="badge badge-success">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @else
                                <td><label
                                        class="badge badge-danger">{{$data->convertTrueFalse($data->is_active) }}</label>
                                </td>
                            @endif
                            <td>{{$data->expired_time}}</td>
                            <td>{{$data->created_at}}</td>
                            <td>{{$data->updated_at}}</td>
                            <td>
                                <button type="button" data-toggle="modal" data-target="#edit{{$data->id}}"
                                        class="btn btn-primary text-white">Edit
                                </button>
                                <button type="button" data-toggle="modal" data-target="#delete{{$data->id}}"
                                        class="btn btn-danger text-white">Delete
                                </button>
                                @include('user.emails.actions.edit-emails')
                                @include('user.emails.actions.delete-emails')
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection

@section('custom-js')
    <script>
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth() + 1; //January is 0 so need to add 1 to make it 1!
        var yyyy = today.getFullYear();
        if (dd < 10) {
            dd = '0' + dd
        }
        if (mm < 10) {
            mm = '0' + mm
        }
        today = yyyy + '-' + mm + '-' + dd;
        document.getElementById("expired_time").setAttribute("min", today);
    </script>
@endsection
@section('emails')
    <script>
        function emails_validate(id) {
            if(!Number.isInteger(id)){
                id = "";
            }
            const password = document.getElementById("password_" + id);
            const password_message = document.getElementById('password_message_' + id);
            if (password.value.length < 3) {
                password_message.innerHTML = "The password must at least 3 character";
                return false;
            } else {
                password_message.innerHTML = "";
                return true;
            }
        }
    </script>
@endsection

