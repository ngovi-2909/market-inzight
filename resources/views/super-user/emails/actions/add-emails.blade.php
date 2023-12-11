<!-- Add Emails Modal -->
<div class="modal fade" id="addEmailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('emails.store')}}" method="POST" onsubmit="return emails_validate()">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="email_">Email address</label>
                        <input type="email" class="form-control" id="email_" name="email" value="{{old('email')}}" placeholder="Email" required>
                        <span class="text-danger" id="emails_message_"></span>
                    </div>
                    <div class="form-group">
                        <label for="password_">Password</label>
                        <input type="password" class="form-control" id="password_" name="password" value="{{old('password')}}" placeholder="Password" required>
                        <span class="text-danger" id="password_message_"></span>

                    </div>

                    <div class="form-group">
                        <label for="expired_time">Expired Time</label>
                        <input type="date" class="form-control" id="expired_time" name="expired_time" value="{{old('expired_time')}}" placeholder="Expired Time">
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
                    <button type="Submit" class="btn btn-primary">Add Email</button>
                </div>
            </form>
        </div>
    </div>
</div>







