@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='show_submission' ng-controller='SubmissionCtrl'>
<div class="col-md-10 col-md-offset-1 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">    
                        <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                        <h5 class='blue-text text-center'>Criteria <a class="btn btn-xm btn-danger" href='{{url("criteria",$tender_id)}}' >Add</a></h5>
                     
<table class="table">

    <thead>
        <tr>
            <th>#</th>
            <th>Rubric</th>
            <th>Weight</th>
            <th>Status</th>
            <th>Action</th>
            
        </tr>
    </thead>
    <tbody>
    @foreach($criterias as $criteria)
        <tr>
            <th scope="row">{{$count=$count+1}}</th>

            <td>{{$criteria->rubric}} </td>
             <td>{{$criteria->weight}} %</td>
           
            <td>
                <input type="checkbox" id="{{$criteria->id}}" ng-click="set_selection('')" @if($criteria->status=='Active') checked='checked' @endif />
         <label for="{{$criteria->id}}"></label>
            </td>

            
            <td><a href="{{url('criteria/'.$criteria->id.'/edit')}}" <i class="material-icons">create</i> </a> </td>
        </tr>
    
        @endforeach
        
    </tbody>
</table>
   
               
             
             </div>
          <!--Image Card-->

      </div>
    </div>
 

  


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
