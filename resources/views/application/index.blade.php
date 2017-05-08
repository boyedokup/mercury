@extends('layouts.dashboard')

@section('content')
<div class="" ng-app='applications' ng-controller='ApplicationsCtrl'>
    <div class="row text-center col-md-12">
        

         <div class="col-md-9 col-sm-12   text-center pull-left">
        
         <div class="col-md-12">
            <div class="card-panel blue">
                <span class="white-text"> All Tenders you created can be managed here
          </span>
            </div>
        </div>

           

<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-pills pills-primary" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" data-toggle="tab" href="#panel21" role="tab"> My Proposal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel22" role="tab"> My Tender</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel23" role="tab"> My Quotation</a>
            </li>
        </ul>

             
    </div>

    <div class="col-md-9 col-sm-12 col-xs-12">
        <!-- Tab panels -->
        <div class="tab-content vertical">

            <!--Panel 1-->
            <div class="tab-pane fade in active" id="panel21" role="tabpanel">
                  
               @if(count($proposals)==0)
               <h5>No Proposals  yet </h5>
               @endif
               
                @foreach($proposals as $proposal)
       

         <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countp % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countp % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$proposal->submission_closing_date->toFormattedDateString()}} </span> </div>

              @if(Carbon\Carbon::now() > $proposal->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else
            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$proposal->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>
            @endif

              <div class="popup dropdown text-left col-md-4 col-sm-3 pull-right">
               <!-- Dropdown Trigger -->
              <a  class=" popup dropdown-toggle"  data-toggle="dropdown" style="color: inherit;"><i class="material-icons">apps</i></a>

              <!-- Dropdown Structure -->
             <ul class=" popup dropdown-menu" style="font-size:2px;padding: 0px;">
              <li><a href="{{url('proposal/'.$proposal->id.'/edit')}}">Edit</a></li>
               <li class="divider"></li>
              <li><a href="{{url('proposal',$proposal->id)}}">Preview</a></li>
              <li><a href="{{url('reply_rfi',$proposal->id)}}">Reply RFI</a></li>
              <li class="divider"></li>
              <li><a  href="{{url('view_tender_criteria',$proposal->id)}}"> Criteria</a></li>
               <li><a  href="#"> Reviewer</a></li>
              
              </ul>
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$proposal->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$proposal->scope_description}} </div>
                    
                          
              
                </div>
                
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">
                
                 @if($proposal->status=='Pending')
          
            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" data-toggle="modal" data-target="#publish" ng-click="set_id('{{$proposal->id}}','proposal')" > Publish</button>

            
           @else

            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("submission",$proposal->id)}}'"> View All Submission ( 1000 )</button>

             @endif

                
               

                <a class='pull-right ' href="#"> GHS {{$proposal->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$proposal->region}} {{$proposal->district}} </a>
                </div>

                
                <span class=" text-center col-md-1 col-sm-12 grey-text  text-darken-2">Tenderer:{{$proposal->user->company->company_registered_name}} </span>
               

                </div><!---second part -->
            </div>
        </div>
    </div>
         <?php $countp++ ?>
        @endforeach
    

            </div>
            <!--/.Panel 1-->

            <!--Panel 2-->
            <div class="tab-pane fade" id="panel22" role="tabpanel">

                 @if(count($tenders)==0)
               <h5>No Tenders  yet </h5>
               @endif
              
                @foreach($tenders as $tender)
          

         <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countt % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countt % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$tender->submission_closing_date->toFormattedDateString()}} </span> </div>

              @if(Carbon\Carbon::now() > $tender->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else
            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$tender->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>
            @endif

              <div class="popup dropdown text-left col-md-4 col-sm-3 pull-right">
               <!-- Dropdown Trigger -->
              <a  class=" popup dropdown-toggle"  data-toggle="dropdown" style="color: inherit;"><i class="material-icons">apps</i></a>

              <!-- Dropdown Structure -->
             <ul class=" popup dropdown-menu" style="font-size:2px;padding: 0px;">
              <li><a href="{{url('tender/'.$tender->id.'/edit')}}">Edit</a></li>
               <li class="divider"></li>
              <li><a href="{{url('tender',$tender->id)}}">Preview</a></li>
              <li><a href="{{url('reply_rfi',$tender->id)}}">Reply RFI</a></li>
              <li class="divider"></li>
              <li><a  href="{{url('view_tender_criteria',$tender->id)}}"> Criteria</a></li>
               <li><a  href="#"> Reviewer</a></li>
              
              </ul>
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$tender->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$tender->scope_description}} </div>
                    
                          
              
                </div>
                
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">
                
                 @if($tender->status=='Pending')
          
            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" data-toggle="modal" data-target="#publish" ng-click="set_id('{{$tender->id}}','tender')" > Publish</button>

            
           @else

            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("submission",$tender->id)}}'"> View All Submission ( 1000 )</button>

             @endif

                
               

                <a class='pull-right ' href="#"> GHS {{$tender->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$tender->region}} {{$tender->district}} </a>
                </div>

                
                <span class=" text-center col-md-1 col-sm-12 grey-text  text-darken-2">Tenderer:{{$proposal->user->company->company_registered_name}} </span>
               

                </div><!---second part -->
            </div>
        </div>
    </div>
         <?php $countt++ ?>
        
        @endforeach
    


            </div>
            <!--/.Panel 2-->

            <!--Panel 3-->
            <div class="tab-pane fade" id="panel23" role="tabpanel">
               
                @if(count($quotations)==0)
               <h5>No Quotations  yet </h5>
               @endif

             @foreach($quotations as $quotation)

            
         <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countq % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countq % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$quotation->submission_closing_date->toFormattedDateString()}} </span> </div>

              @if(Carbon\Carbon::now() > $quotation->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else
            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$quotation->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>
            @endif

              <div class="popup dropdown text-left col-md-4 col-sm-3 pull-right">
               <!-- Dropdown Trigger -->
              <a  class=" popup dropdown-toggle"  data-toggle="dropdown" style="color: inherit;"><i class="material-icons">apps</i></a>

              <!-- Dropdown Structure -->
             <ul class=" popup dropdown-menu" style="font-size:2px;padding: 0px;">
              <li><a href="{{url('quotation/'.$quotation->id.'/edit')}}">Edit</a></li>
               <li class="divider"></li>
              <li><a href="{{url('quotation',$quotation->id)}}">Preview</a></li>
              <li><a href="{{url('reply_rfi',$quotation->id)}}">Reply RFI</a></li>
              <li class="divider"></li>
              <li><a  href="{{url('view_tender_criteria',$quotation->id)}}"> Criteria</a></li>
               <li><a  href="#"> Reviewer</a></li>
              
              </ul>
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$quotation->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$quotation->scope_description}} </div>
                    
                          
              
                </div>
                
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">
                
                 @if($quotation->status=='Pending')
          
            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" data-toggle="modal" data-target="#publish" ng-click="set_id('{{$quotation->id}}','quotation')" > Publish</button>

            
           @else

            <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("submission",$quotation->id)}}'"> View All Submission ( 1000 )</button>

             @endif

                
               

                <a class='pull-right ' href="#"> GHS {{$quotation->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$quotation->region}} {{$quotation->district}} </a>
                </div>

                
                <span class=" text-center col-md-1 col-sm-12 grey-text  text-darken-2">Tenderer:{{$quotation->user->company->company_registered_name}} </span>
               

                </div><!---second part -->
            </div>
        </div>
    </div>
         <?php $countq++ ?>
        
        @endforeach
    
            </div>
            <!--/.Panel 3-->

        </div>
    </div>
</div>


        </div>

    


    
     <div class='col-md-3 col-sm-12 pull-right text-center '>
      
    
         <h4 class='h4-responsive text-center'>Advertise</h4>
      <a class="btn btn-primary btn-rounded ">Create Ad</a>
      


      
     </div>     

    </div>
    
    


<!-- Modal -->
<div class="modal fade" id="publish" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Select Category</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class='row'>
            {!! Form::open(array('url' => 'publish','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}
                       <input type='hidden' name='reference_id' value="<% id %>">
                       <input type='hidden' name='application_type' value="<% application_type %>">

                         @foreach($categories as $category)
                          <div class='col-md-6 col-sm-12' >
                          <h6>{{$category->name}}</h6>
                            
                          
                            <div class="switch">
                            <label>
                              Off
                              <input type="checkbox" name="setting[]" id='{{$category->id}}' ng-click="check({{$category->id}})" value="{{$category->id}}">

                              <span class="lever"></span>
                              On
                            </label>
                           
                          </div></div>
                          
                          @endforeach

                          
                          </div>
        
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">

              <button type="submit" id='publish_btn' class="btn btn-primary btn-md waves-effect waves-light btn-rounded " disabled="disabled">Submit</button>
                 
               {!! Form::close() !!}
              
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->




</div>
<style type="text/css"> 
.nav-tabs
{
box-shadow:none;
}
</style>
<script type="text/javascript">

   var app = angular.module('applications', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('ApplicationsCtrl', function($scope, $http) {
    $scope.array=[];
    

     $scope.set_id= function(id,application_type)
     {
       $scope.id=id;
       $scope.application_type=application_type;
      console.log(id);
     

     }

     $scope.check= function(id)
     {
        status=$('#'+id).is(':checked');
        console.log(status);

        if(status=='true')
        {
        $('#publish_btn').removeAttr('disabled');
        console.log('enable');

        }

     }
    
     
  });





  </script>
@endsection
