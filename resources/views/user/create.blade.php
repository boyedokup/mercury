@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">
                     <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                        <h5 class='blue-text text-center'>Create User</h5>
                        {!! Form::open(array('url' => 'user','method'=>'post','files'=>'true')) !!}
                           {!! Form::token() !!}

                            <div>
                                Name:<span class='red-text text-darken-1'>{{$errors->first('name')}} </span>

                                {!!Form::text('name')!!}
                            </div>

                            <div>
                                Contact:<span class='red-text text-darken-1'>{{$errors->first('contact')}} </span>
                               {!!Form::text('contact')!!}
                            </div>
                            <div>
                                Email:<span class='red-text text-darken-1'>{{$errors->first('email')}} </span>
                                {!!Form::text('email')!!}
                            </div>

                            
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Create User</button>
                

               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>
@endsection
