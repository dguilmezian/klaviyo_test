@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Contacts List') }}</div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($clicked)
                        <div class="alert alert-success" role="alert">
                            Button Clicked
                        </div>
                    @endif
                    <div class="row col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <a href="members/create" style="margin-right: 5px">
                            <button type="button" class="btn btn-primary float-right">
                                New Contact
                            </button>
                        </a>
                        <a href="members/import" style="margin-right: 5px">
                            <button type="button" class="btn btn-primary float-right">
                                Import CSV
                            </button>
                        </a>
                        @if($uploadButton)
                            <a href="members/upload" style="margin-right: 5px">
                                <button type="button" class="btn btn-secondary float-right">
                                    Upload Contacts
                                </button>
                            </a>
                        @endif
                        <a href="button" style="margin-right: 5px">
                            <button type="button" class="btn btn-secondary float-right">
                                Click Event
                            </button>
                        </a>
                    </div>

                    @if(count($members)>0)
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="table-responsive" style="margin-top: 5px;">
                                    <table class="table table-striped table-bordered table-condensed table-hover">
                                        <thead>
                                        <th>Name</th>
                                        <th>E-Mail</th>
                                        <th>Phone Number</th>
                                        <th>Uploaded</th>
                                        </thead>
                                        @foreach ($members as $member)
                                            <tr>
                                                <td>{{$member->name}}</td>
                                                <td>{{$member->email}}</td>
                                                <td>{{$member->phone}}</td>
                                                @if($member->uploaded)
                                                    <td class="alert alert-success" style="text-align: center">YES</td>

                                                @else
                                                    <td class="alert alert-danger" style="text-align: center">NO</td>
                                                @endif
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
