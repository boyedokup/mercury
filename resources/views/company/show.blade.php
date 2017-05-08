@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='show_proposal' ng-controller='ProposalCtrl'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                    <h5 class='blue-text text-center'> {{$company->company_registered_name}} Profile </h5>
                    <dl class="dl-horizontal">
                <dt class="col-sm-6">Company Email</dt>
                <dd class="col-sm-6">{{$company->email}}</dd>

                <dt class="col-sm-3">Company Description</dt>
                <dd class="col-sm-9">{{$company->description}}</dd>

                <dt class="col-sm-6">Country Of Company Location</dt>
                <dd class="col-sm-6">{{$company->country}}</dd>
                
                <dt class="col-sm-3">City Of Company Location</dt>
                <dd class="col-sm-9">{{$company->city}}</dd>

                <dt class="col-sm-3">Organization Type</dt>
                <dd class="col-sm-9">{{$company->organizational_type}}</dd>

                <dt class="col-sm-3">Number Of Employees</dt>
                <dd class="col-sm-9"> {{$company->number_of_employees}}</dd>
                
                <dt class="col-sm-3">Has Local Content</dt>
                <dd class="col-sm-9">{{$company->has_local_content}}</dd>

                 <dt class="col-sm-3">Annual Turn Over</dt>
                <dd class="col-sm-9">{{$proposal->annual_turnover}}</dd>
                
               <div class='col-md-12 text-center'> 
               <hr>
               <h6> Attached Documents</h6>
              
                 <ul>
                 
                    <li><a href="#"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Company Documents</a> </li>
                    
                   
                 </ul>
               
                 </div>
                 
          </div>
          <!--Image Card-->

      </div>
    </div>

</div>

 <script type="text/javascript">

   var app = angular.module('show_proposal', [], function($interpolateProvider) {
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
