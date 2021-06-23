@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Public API Key</h4>
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
                        @if ($message)
                            <div class="alert alert-success">
                                {{$message}}
                            </div>
                        @endif
                        {!!Form::open((array('url' => 'publickey', 'method'=>'POST', 'autocomplete'=>'off')))!!}
                        {{Form::token()}}
{{--                        {{ csrf_field() }}--}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cname">Public API Key</label>
                                    <input type="text" class="form-control" name="public_api_key" id="public_api_key" value="{{$public_api_key}}"
                                           placeholder="Public API Key" required>
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
