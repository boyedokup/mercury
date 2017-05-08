@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                  <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                    <h5 class='blue-text text-center'>Create Quotation</h5>
                   {!! Form::open(array('url' => 'quotation','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}
                

                <div class='input-field'>
                   {!! Form::text('name') !!}
                <label for="name" >Quotation Name:<span class='red-text text-darken-1'>{{$errors->first('name')}}</span></label>
               
                </div>


                <div class='input-field'>
                {!!Form::textarea('scope_description',null,["class"=>"materialize-textarea"])!!}
                <label for="description">Scope Description:<span class='red-text text-darken-1'>{{$errors->first('scope_description')}}</span></label>

                </div>
                

                <div class='input-field'>
                   {!! Form::text('awarding_institution') !!}
                <label for="contract">Awarding Institution:<span class='red-text text-darken-1'>{{$errors->first('awarding_institution')}}</span></label>

                </div>

                
                <div class='input-field'>
                   {!! Form::text('ministry') !!}
                <label for="ministry">Ministry:<span class='red-text text-darken-1'>{{$errors->first('ministry')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('region') !!}
                <label for="region">Region:<span class='red-text text-darken-1'>{{$errors->first('region')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('district') !!}
                <label for="district">District:<span class='red-text text-darken-1'>{{$errors->first('district')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('no_of_lots') !!}
                <label for="district">Number of Lots:<span class='red-text text-darken-1'>{{$errors->first('no_of_lots')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('contact') !!}
                <label for="contact">Contact:<span class='red-text text-darken-1'>{{$errors->first('contact')}}</span></label>

                </div>
               
                 
                 <div class='input-field'>
                   {!! Form::number('price','0.00') !!}
                <label for="contact">Price:<span class='red-text text-darken-1'>{{$errors->first('price')}}</span></label>

                </div>

               <div class='input-field'>
                {!!Form::textarea('documents',null,["class"=>"materialize-textarea",'placeholder'=>'separate by comma'])!!}
                <label for="documents">Required Documents from Applicants:<span class='red-text text-darken-1'>{{$errors->first('documents')}}</span></label>

                </div>


                 <div class='input-field'>
                 {!!Form::date('submission_closing_date', Carbon\Carbon::now(),['class'=>'datepicker'])!!}
                 <label for="date">Submision Closing date:<span class='red-text text-darken-1'>{{$errors->first('submission_closing_date')}}</span></label>

               </div>
    
                  <input type='hidden' value='{{$id=str_random(20)}}' name='id'>
               
                 <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#quotation">Attach Documents</button>

              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Create</button>
                 

               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>

  <!-- Modal -->
<div class="modal fade" id="quotation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Attach PDF Documents</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
             
            <form action="{{url('file')}}" class="dropzone" id="my-awesome-dropzone" method='post' enctype="multipart/form-data">

                     {{ csrf_field() }}
             <input type="hidden" name="reference_id" value="{{$id}}">

           </form>
             
             
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">
               <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded"  data-dismiss="modal" >Done</button>
              
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->
 
@endsection
