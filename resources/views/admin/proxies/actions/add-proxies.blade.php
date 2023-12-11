<!-- Add Proxies Modal -->
<div class="modal fade" id="addProxyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form class="forms-sample" action="{{route('proxies.store')}}" method="POST" onsubmit="return proxyValidate()">
                @csrf
                @method('POST')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="host_">Host</label>
                        <input type="text" class="form-control" id="host_" name="host" placeholder="Host" value="{{old('host')}}">
                        <span class="text-danger" id="host_message_"></span>

                    </div>
                    <div class="form-group">
                        <label for="port_">Port</label>
                        <input type="number" class="form-control" id="port_" name="port" value="{{old('port')}}" placeholder="Port" min="0">
                        <span class="text-danger" id="port_message_"></span>

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
                    <button type="Submit" class="btn btn-primary">Add Proxy</button>
                </div>
            </form>
        </div>
    </div>
</div>

