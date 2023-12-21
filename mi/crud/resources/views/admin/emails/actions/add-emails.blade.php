<!-- Add Emails -->
@extends('crud::layouts.master')
@section('content')
    <div class="col-md-8 grid-margin stretch-card">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 card">
                <div class="card-body">
                <form class="forms-sample" action="{{route('emails.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}" placeholder="Email">
                            @if($errors->has('email'))
                                <span class="text-danger" id="emails_message">{{$errors->first('email')}}</span>
                            @endif

                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password" value="{{old('password')}}" placeholder="Password" >
                            @if($errors->has('password'))
                                <span class="text-danger" id="password_message">{{$errors->first('password')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="status">Status </label>
                            <select class="form-select" aria-label="Default select example" id="status" name="status">
                                <option value="">none</option>
                                @foreach($status as $value)
                                    <option value="{{$value}}"
                                            @if($value == old('status'))
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
                                            @if($key == old('blocked_in'))
                                                selected = "selected"
                                        @endif
                                    >{{$key}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('blocked_in'))
                                <span class="text-danger" id="blocked_in_message">{{$errors->first('blocked_in')}}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="expired_time">Expired Time</label>
                            <input type="date" class="form-control" id="expired_time" name="expired_time" value="{{old('expired_time')}}" placeholder="Expired Time">
                        </div>

                    </div>

                    <div class="modal-footer">
                        <a href="{{route('emails.index')}}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                        <button type="Submit" class="btn btn-primary">Add Email</button>
                    </div>
                </form>
                </div>
                </div>
            </div>
        </div>
    </div>
@endsection




