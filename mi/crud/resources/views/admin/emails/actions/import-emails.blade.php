<!-- Import Emails -->
@extends('crud::layouts.master')
@section('content')
    <div class="col-md-8 grid-margin stretch-card">
        <div class="container">
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-8 card">
                    <div class="card-body">
                        <form class="forms-sample" action="{{route('emails.import')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="file">Email address</label>
                                    <input type="file" class="form-control" id="file" name="file" accept=".xlsx, .xls, .csv">
                                </div>
                                @if($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <li>
                                            <span class="text-danger">{{ $error }}</span>
                                        </li>
                                    @endforeach
                                @endif
                            </div>

                            <div class="modal-footer">
                                <a href="{{route('emails.index')}}" type="button" class="btn btn-secondary" data-dismiss="modal" >Close</a>
                                <button type="Submit" class="btn btn-primary">Import</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

