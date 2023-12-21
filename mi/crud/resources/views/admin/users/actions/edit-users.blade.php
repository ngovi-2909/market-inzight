<!-- Edit Users -->
@extends('crud::layouts.master')
@section('content')
    <div class="col-md-8 grid-margin stretch-card">
    <div class="container">
    <div class="row">
        <div class="col-md-4"></div>
            <div class="col-md-8 card">
                <div class="card-body">
                <form class="forms-sample" action="{{route('users.update', ['user' => $data->id])}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{$data->email}}" disabled placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger" id="email_message">{{$errors->first('email')}}</span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{$data->password}}" placeholder="Password">
                            @if($errors->has('password'))
                                <span class="text-danger" id="password_message">{{$errors->first('password')}}</span>
                            @endif

                        </div>

                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_super_user" value="1" {{$data->is_super_user == 1? 'checked':''}}>
                                Super User
                                <i class="input-helper"></i></label>
                        </div>

                        <div class="form-check form-check-flat form-check-primary">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input" name="is_active" value="1" {{$data->is_active == 1? 'checked':''}}>
                                Active
                                <i class="input-helper"></i></label>

                        </div>
                    </div>

                    <div class="modal-footer">
                        <a href="{{route('users.index')}}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="Submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
                </div>
            </div>
    </div>
    </div>
    </div>
@endsection

