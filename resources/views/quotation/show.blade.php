@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='show_quotation' ng-controller='QuotationCtrl'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                    <h5 class='blue-text text-center'> {{$quotation->name}}</h5>
                    <dl class="dl-horizontal">
                <dt class="col-sm-3">Company</dt>
                <dd class="col-sm-9">{{$quotation->user->company->company_registered_name}}</dd>

                <dt class="col-sm-3">Scope Description</dt>
                <dd class="col-sm-9">{{$quotation->scope_description}}</dd>

                <dt class="col-sm-3">Awarding Institution</dt>
                <dd class="col-sm-9">{{$quotation->awarding_institution}}</dd>

                 <dt class="col-sm-3">Ministry</dt>
                <dd class="col-sm-9">{{$quotation->ministry}}</dd>

                <dt class="col-sm-3">Region</dt>
                <dd class="col-sm-9">{{$quotation->region}}</dd>

                <dt class="col-sm-3">District</dt>
                <dd class="col-sm-9">{{$quotation->district}}</dd>

                <dt class="col-sm-3">Number Of Lots</dt>
                <dd class="col-sm-9">{{$quotation->no_of_lots}}</dd>


                <dt class="col-sm-3">Application Fee </dt>
                <dd class="col-sm-9"> GHS {{$quotation->price}}.00</dd>
                
                <dt class="col-sm-3">Applicaiton Contact</dt>
                <dd class="col-sm-9">{{$quotation->contact}}</dd>
                
               <div class='col-md-12 text-center'> 
               <hr>
               <h6> Attached Documents</h6>
                @if($submission  && $submission->payment_status=='Paid' || $quotation->price ==0.00)
                 <ul>
                    @foreach($attachments as $attachment)
                    <li><a href="{{asset('application_files')}}/{{$attachment->url}}" target='_blank'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{$attachment->url}}</a> </li>
                    
                    @endforeach
                 </ul>
                 @endif
                 </div>
               
                @if($quotation->submission_closing_date >= Carbon\Carbon::now())
                
               <div class='col-md-12 text-center'>
                @if($submission==null)
                <a class="btn btn-info waves-effect waves-light " href="{{url('save_application/'.$quotation->id.'/quotation')}}">Save for later</a>    @endif

               @if($submission  && $submission->payment_status=='Paid' || $quotation->price ==0.00)
            <a class="btn btn-info waves-effect waves-light "  data-toggle="modal" data-target="#apply_now">Apply Now</a>

              @else

              <a class="btn btn-info waves-effect waves-light " href="{{url('pay_for_tender/'.$quotation->price.'/'.$quotation->id.'/quotation')}}">Pay For Tender</a>
              @endif

              
               @endif
                

                  @if($quotation->submission_closing_date < Carbon\Carbon::now())
                 
                    <a class="btn btn-info waves-effect waves-light " href="{{url('submission',$quotation->id)}}">View All Submissions</a>
                  @


                  @if($submission  && $submission->status=='Awarded' )

                    <a class="btn btn-info waves-effect waves-light yellow " data-toggle="modal" data-target="#accept_contract">Accept Awarded Contract</a>
                  @endif
                 

                  </div>
          </div>
          <!--Image Card-->

      </div>
    </div>
  

<!-- Modal -->
<div class="modal fade" id="apply_now" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
            <div class='text-center'>
            <h6>Required Documents </h6>
            <ol>
              @foreach($documents as $document)
                 <li>{{$document}}</li>
              @endforeach
                 
            </ol></div>
            <hr>
            <form action="{{url('file')}}" class="dropzone" id="my-awesome-dropzone" method='post' enctype="multipart/form-data">

                     {{ csrf_field() }}
                     <input type='hidden' name='reference_id' value='{{$quotation->id}}'>


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
            @if($submission && $submission->status=='Submitted')
                <a class="btn btn-info waves-effect waves-light  pull-left" href="#" disabled>All uploads will be added automatically</a>
                 <a class="btn btn-info waves-effect waves-light " data-dismiss='modal'>Done</a>
            @else
               <a class="btn btn-info waves-effect waves-light  pull-left" href="{{url('submit_now/'.$quotation->id.'/quotation')}}">Submit Now</a>
               <a class="btn btn-info waves-effect waves-light " href="{{url('submit_later/'.$quotation->id.'/quotation')}}">Submit Later</a>
              @endif

               <a class="btn btn-info waves-effect waves-light "  href="{{url('request_for_info/'.$quotation->id)}}">RFI</a>
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->
 
<!-- Modal -->
<div class="modal fade" id="accept_contract" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Award Contract </h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class='text-center'>

             {!! Form::open(array('url' => 'accept_contract','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}

                            <p>
                              By clicking the the check button you append your Electronic Signature saying you have accepted the awarded contract to <b> {{$submission->user->company->company_registered_name}} </b> and all legal actions are binding per the contract
                         <hr></hr>
                          <input type="checkbox"  name="agree" id='agree'>
                          <label for="agree"> Click to agree</label>  
                            </p>
                          
                          <input type="hidden" name="id" value="{{$submission->id}}">
                          <input type="hidden" name="reference" value="{{$submission->reference_id}}">
                          <input type="hidden" name="type" value="{{$submission->type}}">
                            
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Confirm Acceptance</button>
                

               </div>{!! Form::close()!!}
        
            </div>
            
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">
           
                 <a class="btn btn-info waves-effect waves-light " data-dismiss='modal'>Cancel</a>
            
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->

 </div>
 <script type="text/javascript">

   var app = angular.module('show_quotation', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('QuotationCtrl', function($scope, $http) {
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
