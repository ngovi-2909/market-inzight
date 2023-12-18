{{--Emails Index--}}
@php use mi\crud\Repositories\UserRepository; @endphp
@extends('crud::layouts.master')
@section('content')
    @include('crud::admin.emails.actions.add-emails')
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
                        <th>Email</th>
                        <th>Is Active</th>
                        <th>Expired Time</th>
                        <th>Created By</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                            @if($data->is_super_user)
                                <td>{{$data->id}}</td>
                            @else
                                <td>{{$loop->index+1}}</td>
                            @endif
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
                                @include('crud::admin.emails.actions.edit-emails')
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

@if($errors->has('email'))
    <!-- Delete Users Modal -->
    <div class="modal fade show " id="showError" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="false" style="display:block;">
        <div class="modal-dialog" role="document">
            <div class="modal-content border border-warning">
                <div class="modal-body bg-warning">
                    <p>{{$errors->first('email')}}. Please try again!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="window.location.reload();">Close</button>
                </div>
            </div>
        </div>
    </div>

@endif
@section('emails')
    <script>
        function emailValidate(id) {
            if (!Number.isInteger(id)) {
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
