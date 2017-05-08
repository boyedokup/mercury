@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='show_submission' ng-controller='SubmissionCtrl'>
<div class="col-md-10 col-md-offset-1 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">    
                        <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                        <h5 class='blue-text text-center'>{{$application->name}} Submissions <a class="btn btn-xm btn-danger" href='{{url("submission_pdf_download",$application->id)}}' target="_blank"><i class="fa fa-download" aria-hidden="true"></i></a></h5>
                     
<table class="table">

    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Files</th>
             <th>Total Cost</th>
             <th>Status</th>
            @if($application->status =='Published')
             <th>Action</th>

             @endif
          
        </tr>
    </thead>
    <tbody>
    @foreach($submissions as $submission)
        <tr>
            <th scope="row">{{$count=$count+1}}</th>

            <td>{{$submission->user->name}}</td>
             <td><a href="{{url('company',$submission->user->company_id)}}"> {{$submission->user->company->company_registered_name}} </a></td>
              <td>{{$submission->user->contact}}</td>
               <td>{{$submission->user->email}}</td>

          
            <td>
                @if( Carbon\Carbon::now() > $application->submission_closing_date )
                <a class=""  data-toggle="modal" data-target="#files" ng-click="get_files('{{$submission->user->id}}','{{$submission->reference_id}}','{{$submission->user->company->company_registered_name}}')"><i class="fa fa-files-o" aria-hidden="true"></i></a>
                @else
               <a class='red-text'>  <i class="fa fa-files-o " aria-hidden="true"></i></a>
                @endif
               
            </td>
            <td> {{$submission->total_cost}}</td>
             <td><a href="{{url('review_summary',$submission->id)}}"> {{$submission->selected}} </a></td>

            @if( Carbon\Carbon::now() > $application->submission_closing_date )
            @if(Auth::user()->id==$application->user_id)
           
             @if($application->status =='Published')
              
             @if( $submission->selected=='Qualified' )
            <td>
                <a class=""  data-toggle="modal" data-target="#award" ng-click="award_contract('{{$submission->id}}','{{$submission->reference_id}}','{{$submission->user->company->company_registered_name}}','{{$submission->type}}')"> Award Contract</a> 
            </td>
            @endif

             @if( $submission->selected=='Pending Review' )
            <td>
                <a class=""  href="{{url('review',$submission->id)}}"> Review</a> 
            </td>
            @endif
            
            @endif
            @endif
            @endif
            
        </tr>
    
        @endforeach
        
    </tbody>
</table>
   
               
             
             </div>
          <!--Image Card-->

      </div>
    </div>
 

  <!-- Modal -->
<div class="modal fade" id="files" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel"><% name %> Submitted Documents</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class='text-center'>
        
            <ol>
              <li ng-repeat="file in files">
                <a href="{{asset('application_files')}} /<% file.url %>" target='_blank'>  <% file.url %>  </a>
                 </li>
                 
            </ol></div>
            
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">
           
                 <a class="btn btn-info waves-effect waves-light " data-dismiss='modal'>Done</a>
            
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->



  <!-- Modal -->
<div class="modal fade" id="award" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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

             {!! Form::open(array('url' => 'award_contract','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}

                            <p>
                              By clicking the the check button you append your Electronic Signature saying you awarded
                              this contract to   <b><% company %> </b> and all legal actions are binding per the contract
                         <hr></hr>
                          <input type="checkbox"  name="agree" id='agree'>
                          <label for="agree"> Click to agree</label>  
                            </p>
                          
                          <input type="hidden" name="id" value="<% id %>">
                          <input type="hidden" name="reference" value="<% reference %>">
                          <input type="hidden" name="type" value="<% type %>">
                            
              <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Confirm Award</button>
                

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

   var app = angular.module('show_submission', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('SubmissionCtrl', function($scope, $http) {
  

     $scope.get_files= function(user_id,app_id,name)
     {
       $scope.name=name;
     
       $http.get("{{url('get_files')}}"+'/'+user_id+'/'+app_id)
      .success(function(response) {$scope.files=response;});
     

     }

     $scope.set_selection= function(id)
     {
        status=$('#'+id).is(':checked');
    
        
       $http.get("{{url('set_selection')}}"+'/'+id+'/'+status)
      .success(function(response) {console.log(response);});
      console.log(id+' '+status);
     
     }
    

     $scope.award_contract= function(id,reference,company,type)
     {
        
        $scope.company=company;
        $scope.reference=reference;
        $scope.id=id;
        $scope.type=type

      console.log(id+' '+reference+' '+company);
     }

     
  });



  </script>
@endsection
