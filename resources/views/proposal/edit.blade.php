@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='edit_proposal' ng-controller='ProposalCtrl'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">
                
                <div class="card-content">
                    <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                    <h5 class='blue-text text-center'>Update Proposal</h5>
                   {!! Form::model($proposal, array('route' => array('proposal.update',$proposal->id),'method'=>'put','files'=>true)) !!}
                       {!! Form::token() !!}
                

                <div class='input-field'>
                   {!! Form::text('name') !!}
                <label for="name" >Proposal Name:<span class='red-text text-darken-1'>{{$errors->first('name')}}</span></label>
               
                </div>


                <div class='input-field'>
                   {!! Form::text('awarding_institution') !!}
                <label for="awarding_institution">Awarding Institution:<span class='red-text text-darken-1'>{{$errors->first('awarding_institution')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('agency') !!}
                <label for="agency">Agency:<span class='red-text text-darken-1'>{{$errors->first('agency')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('funding') !!}
                <label for="postal_address">Funding:<span class='red-text text-darken-1'>{{$errors->first('funding')}}</span></label>

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
                {!!Form::textarea('scope_description',null,["class"=>"materialize-textarea"])!!}
                <label for="scope_description">Scope Description:<span class='red-text text-darken-1'>{{$errors->first('scope_description')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('price') !!}
                <label for="contact">Price:<span class='red-text text-darken-1'>{{$errors->first('price')}}</span></label>

                </div>

                

               <div class='input-field'>
                {!!Form::textarea('documents',null,["class"=>"materialize-textarea",'placeholder'=>'separate by comma'])!!}
                <label for="documents">Required Documents from Applicants:<span class='red-text text-darken-1'>{{$errors->first('documents')}}</span></label>

                </div>

                
                <div class='input-field'>
                 {!!Form::date('submission_closing_date',$proposal->submission_closing_date,['class'=>'datepicker'])!!}
                 <label for="date">Submision Closing date:<span class='red-text text-darken-1'>{{$errors->first('submission_closing_date')}}</span></label>

               </div>
                      
                 
                <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#proposal">Attach Documents</button>
                 
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Update</button>
                 
                      
               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
 
  
  <!-- Modal -->
<div class="modal fade" id="proposal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
             <input type="hidden" name="reference_id" value="{{$proposal->id}}">

           </form>
             
             <hr>
             <div class='text-center'>
             <h6>Files Attached </h6>
             <ul>
                  @foreach($files as $file)
                <li id="{{$file->id}}"><a href="{{asset('application_files')}}/{{$file->url}}" target='_blank'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{$file->url}}</a>  <i class="fa fa-close red-text" aria-hidden="true" ng-click="delete_file('{{$file->id}}')"></i></li> 
                   @endforeach
            </ul>

             </div>
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

 </div>
<script type="text/javascript">

   var app = angular.module('edit_proposal', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('ProposalCtrl', function($scope, $http) {
    $scope.array=[];
    

     $scope.delete_file= function(id)
     {
      
       
       $http.delete("{{url('file')}}"+'/'+id)
      .success(function(response) {console.log(response);});
      console.log(id);
      $('#'+id).remove();
     }
    
     
  });



  </script>
 
@endsection
