<!-- Edit Proxies Modal -->
<div class="modal fade" id="edit{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('proxies.update', $data->id)}}" method="POST" onsubmit="return proxyValidate({{$data->id}})">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="host_{{$data->id}}">Host</label>
                        <input type="text" class="form-control" id="host_{{$data->id}}" name="host" value="{{$data->host}}" placeholder="Host">
                        <span class="text-danger" id="host_message_{{$data->id}}"></span>
                    </div>
                    <div class="form-group">
                        <label for="port_{{$data->id}}">Port</label>
                        <input type="number" class="form-control" id="port_{{$data->id}}" name="port" value="{{$data->port}}" placeholder="Port">
                        <span class="text-danger" id="port_message_{{$data->id}}"></span>
                    </div>
                    @if(auth()->user()->is_super_user)
                        <div class="form-group">
                            <label for="created_by_{{$data->id}}">Created By</label>
                            <input type="text" class="form-control" id="created_by_{{$data->id}}" name="created_by" value="{{$data->created_by}}" placeholder="Expired Time">
                        </div>
                    @endif
                    <div class="form-check form-check-flat form-check-primary">
                        <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="is_active" value="1" {{$data->is_active == 1? 'checked':''}}>
                            Active
                            <i class="input-helper"></i></label>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="Submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>
</div>


