@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">
                     <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                        <h5 class='blue-text'>Cashout-{{$application->name}}</h5>
                        {!! Form::open(array('url' => 'cashout','method'=>'post','files'=>'true')) !!}
                           {!! Form::token() !!}
                             

                            <div>
                                Bank Name:<span class='red-text text-darken-1'>{{$errors->first('bank')}} </span>

                                {!!Form::text('bank')!!}
                            </div>

                            <div>
                                Bank Branch:<span class='red-text text-darken-1'>{{$errors->first('branch')}} </span>
                               {!!Form::text('branch')!!}
                            </div>
                            <div>
                            <div>
                                Account Name:<span class='red-text text-darken-1'>{{$errors->first('account_name')}} </span>
                                {!!Form::text('account_name')!!}
                            </div>
                                Account Number:<span class='red-text text-darken-1'>{{$errors->first('account_no')}} </span>
                                {!!Form::text('account_no')!!}
                            </div>
                            <div>
                               Confirm Account Number:<span class='red-text text-darken-1'>{{$errors->first('account_no_confirmation')}} </span>
                                {!!Form::text('account_no_confirmation')!!}
                            </div>
                            <input type='hidden' name='closing_date' value='{{$application->submission_closing_date}}'>
                             <input type='hidden' name='balance' value='{{$application->balance}}'>
                              <input type='hidden' name='type' value='{{$type}}'>
                               <input type='hidden' name='reference_id' value='{{$application->id}}'>
                            
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded" @if($application->cashed_out !='') disabled @endif >Send Request</button>
                
               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>
@endsection
