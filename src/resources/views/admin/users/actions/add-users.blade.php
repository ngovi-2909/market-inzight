<!-- Modal -->
<div class="modal fade" id="addUserModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('users.store')}}" method="POST" onsubmit="return userValidate()">
                @csrf
                @method('POST')
            <div class="modal-body">
                <div class="form-group">
                    <label for="first_name_">First Name</label>
                    <input type="text" class="form-control" id="first_name_" name="first_name" value="{{old('first_name_')}}" placeholder="First Name" required>
                    <span class="text-danger" id="first_name_message_"></span>
                </div>
                <div class="form-group">
                    <label for="last_name_">Last Name</label>
                    <input type="text" class="form-control" id="last_name_" name="last_name" value="{{old('last_name_')}}" placeholder="Last Name" required>
                    <span class="text-danger" id="last_name_message_"></span>
                </div>
                <div class="form-group">
                    <label for="email_">Email address</label>
                    <input type="email" class="form-control" id="email_" name="email" value="{{old('email_')}}" placeholder="Email" required>
                    <span class="text-danger" id="email_message_"></span>
                </div>
                <div class="form-group">
                    <label for="password_">Password</label>
                    <input type="password" class="form-control" id="password_" name="password" value="{{old('password_')}}" placeholder="Password" required>
                    <span class="text-danger" id="password_message_"></span>
                </div>
                <div class="form-group">
                    <label for="phone_">Phone</label>
                    <input type="tel" class="form-control" id="phone_" name="phone" value="{{old('phone_')}}" placeholder="Phone Number" required>
                    <span class="text-danger" id="phone_message_"></span>
                </div>
                <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_super_user" value="1">
                         Super User
                        <i class="input-helper"></i></label>
                </div>

                <div class="form-check form-check-flat form-check-primary">
                    <label class="form-check-label">
                        <input type="checkbox" class="form-check-input" name="is_active" value="1">
                        Active
                        <i class="input-helper"></i></label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" onClick="window.location.reload();">Close</button>
                <button type="Submit" class="btn btn-primary btn-submit">Add User</button>
            </div>
            </form>
        </div>
    </div>
</div>


