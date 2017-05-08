@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">
                     <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                        <h5 class='blue-text'> Request For Information: <br>{{$application->name}} </br></h5>
                         {!! Form::open(array('url' => 'request_for_info','method'=>'post','files'=>'true')) !!}
                           {!! Form::token() !!}

                            <div class='input-field'>
                {!!Form::textarea('message',null,["class"=>"materialize-textarea"])!!}
                <label for="scope_description">Message:<span class='red-text text-darken-1'>{{$errors->first('message')}}</span></label>

                </div>

                   <input type='hidden' name='reference_id' value='{{$application->id}}' >
                   <input type='hidden' name='user_id' value='{{$application->user_id}}' >
                            
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Send</button>
                

               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>
@endsection
