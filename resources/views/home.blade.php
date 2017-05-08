@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                       {{storage_path('app\public\flexiPay.png')}}
                    <img src="{{storage_path('app\public\flexiPay.png')}}" width='100px' height="auto">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
