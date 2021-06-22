@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Contacts List') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if(count($members)>0))
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Phone Number</th>
                                        </thead>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{$member->name}}</td>
                                                <td>{{$member->email}}</td>
                                                <td>{{$member->phone}}</td>
                                            </tr>
                                        @endforeach
                                    </table>

                                </div>
                                {{$members->appends(request()->query())->links()}}
                            </div>
                        </div>
                        @else
                            There are no contacts
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
