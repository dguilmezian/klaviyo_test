@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>New Member</h4>
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
                        {!!Form::open((array('url' => 'members', 'method'=>'POST', 'autocomplete'=>'off')))!!}
                        {{Form::token()}}
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="cname">Name</label>
                                    <input type="text" class="form-control" name="name" id="name" value=""
                                           placeholder="Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="cname">E-Mail</label>
                                    <input type="email" class="form-control" name="email" id="email" value=""
                                           placeholder="E-Mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="cname">Phone Number</label>
                                    <input type="text" class="form-control" name="phone" id="phone" value=""
                                           placeholder="Phone Number" required>
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
