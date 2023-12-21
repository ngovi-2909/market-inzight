<!-- Edit Proxies -->
@extends('crud::layouts.master')
@section('content')
    <div class="col-md-8 grid-margin stretch-card">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 card">
                    <div class="card-body">
                    <form class="forms-sample" action="{{route('proxies.update', $data->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="host">Host</label>
                                <input type="text" class="form-control" id="host" name="host" value="{{$data->host}}" placeholder="Host">
                                @if($errors->has('host'))
                                    <span class="text-danger" id="host_message">{{$errors->first('host')}}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="port">Port</label>
                                <input type="number" class="form-control" id="port" name="port" value="{{$data->port}}" placeholder="Port">
                                @if($errors->has('port'))
                                    <span class="text-danger" id="port_message">{{$errors->first('port')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="{{$data->username}}">
                                @if($errors->has('username'))
                                    <span class="text-danger" id="host_message">{{$errors->has('username')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="text" class="form-control" id="password" name="password" placeholder="Password" value="{{$data->password}}">
                                @if($errors->has('password'))
                                    <span class="text-danger" id="host_message">{{$errors->has('password')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="status">Status </label>
                                <select class="form-select" aria-label="Default select example" id="status" name="status">
                                    <option value="">none</option>
                                    @foreach($status as $value)
                                        <option value="{{$value}}"
                                                @if(strtolower($data->status) == strtolower($value))
                                                    selected = "selected"
                                               @endif
                                        >{{$value}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('status'))
                                    <span class="text-danger" id="status_message">{{$errors->first('status')}}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="blocked_in">Blocked in </label>
                                <select class="form-select" aria-label="Default select example" id="blocked_in" name="blocked_in">
                                    <option value="">none</option>
                                    @foreach($options as $key)
                                        <option value="{{$key}}"
                                                @if(strtolower($data->blocked_in )== strtolower($key) )
                                                    selected = "selected"
                                               @endif
                                        >{{$key}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('blocked_in'))
                                    <span class="text-danger" id="blocked_in_message">{{$errors->first('blocked_in')}}</span>
                                @endif
                            </div>

                            @if(auth()->user()->is_super_user)
                                <div class="form-group">
                                    <label for="created_by">Created By</label>
                                    <input type="text" class="form-control" id="created_by" name="created_by" value="{{$data->created_by}}" placeholder="Expired Time">
                                </div>
                            @endif

                        </div>

                        <div class="modal-footer">
                            <a href="{{route('proxies.index')}}" type="button" class="btn btn-secondary">Close</a>
                            <button type="Submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
