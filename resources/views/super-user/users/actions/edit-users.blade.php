<!-- Edit Users Modal -->
<div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('users.update', $data->id)}}" method="POST" onsubmit="return validateUsers({{$data->id}})">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="first_name_{{$data->id}}">First Name</label>
                        <input type="text" class="form-control" id="first_name_{{$data->id}}" name="first_name" value="{{$data->first_name}}" placeholder="First Name" required>
                        <span class="text-danger" id="first_name_message_{{$data->id}}"></span>
                    </div>
                    <div class="form-group">
                        <label for="last_name_{{$data->id}}">Last Name</label>
                        <input type="text" class="form-control" id="last_name_{{$data->id}}" name="last_name" value="{{$data->last_name}}" placeholder="Last Name" required>
                        <span class="text-danger" id="last_name_message_{{$data->id}}"></span>
                    </div>
                    <div class="form-group">
                        <label for="email_{{$data->id}}">Email address</label>
                        <input type="email" class="form-control" id="email_{{$data->id}}" name="email" value="{{$data->email}}" disabled placeholder="Email" required>
                        <span class="text-danger" id="email_message_{{$data->id}}"></span>
                    </div>
                    <div class="form-group">
                        <label for="password_{{$data->id}}">Password</label>
                        <input type="password" class="form-control" id="password_{{$data->id}}" name="password" value="{{$data->password}}" placeholder="Password" required>
                        <span class="text-danger" id="password_message_{{$data->id}}"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone_{{$data->id}}">Phone</label>
                        <input type="tel" class="form-control" id="phone_{{$data->id}}" name="phone" value="{{$data->phone}}" placeholder="Phone Number" required>
                        <span class="text-danger" id="phone_message_{{$data->id}}"></span>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.reload();">Close</button>
                    <button type="Submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


