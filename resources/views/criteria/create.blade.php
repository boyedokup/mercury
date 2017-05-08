@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">
                     <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                        <h5 class='blue-text'>New Criteria</h5>
                        {!! Form::open(array('url' => 'criteria','method'=>'post','files'=>'true')) !!}
                           {!! Form::token() !!}
                             

                             <div class='input-field'>
                {!!Form::textarea('rubric',null,["class"=>"materialize-textarea"])!!}
                <label for="rubric">Rubric/Criteria:<span class='red-text text-darken-1'>{{$errors->first('rubric')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('weight') !!}
                <label for="weight">Weight:<span class='red-text text-darken-1'>{{$errors->first('weight')}}</span></label>

                </div>

                 <div>
                <input type="checkbox" id="id"   name='type' />
               <label for="id"> Check this if you are just validating a document.This will create a checkbox field  </label>

               </div>

                            <input type='hidden' name='tender_id' value='{{$tender_id}}'>
                             
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
