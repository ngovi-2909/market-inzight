<!-- Edit Emails Modal -->
<div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('emails.update', $data->id)}}" method="POST" onsubmit="return emails_validate({{$data->id}})">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email_{{$data->id}}">Email address</label>
                        <input type="email" class="form-control" id="email_{{$data->id}}" name="email" value="{{$data->email}}" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <label for="password_{{$data->id}}">Password</label>
                        <input type="text" class="form-control" id="password_{{$data->id}}" name="password" value="{{$data->password}}" placeholder="Password" required>
                        <span class="text-danger" id="password_message_{{$data->id}}"></span>
                    </div>
                    <div class="form-group">
                        <label for="expired_time_{{$data->id}}">Expired Time</label>
                        <input type="date" class="form-control" id="expired_time_{{$data->id}}" name="expired_time" value="{{$data->expired_time}}" placeholder="Expired Time">
                    </div>

                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" {{$data->is_active == 1? 'checked':''}}>
                            Active
                            <i class="input-helper"></i></label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btnClose"  onClick="window.location.reload();">Close</button>
                    <button type="Submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

</div>


