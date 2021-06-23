@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Import Members CSV. (name,email,phone)</h4>
                    </div>
                    <div class="card-body">
                        @if (count($errors)>0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!!Form::open((array('url' => 'members/import', 'method'=>'POST', 'autocomplete'=>'off','files' => true)))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="members">CSV File</label>
                                    <input type="file" class="form-control" name="members" id="members"
                                           placeholder="Members" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-success mt-2" type="submit" id="savebtn">Submit</button>
                            </div>
                        </div>
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
