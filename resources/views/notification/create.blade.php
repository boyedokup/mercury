@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='create_notification' ng-controller='NotificationCtrl'>
<div class="col-md-10 col-md-offset-1 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">    
                        <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                        <h5 class='blue-text text-center'>Tender Notification Settings </h5>
                        

                           <div class='row'>
                           @foreach($categories as $category)
                          <div class='col-md-3'>
                          <h6>{{$category->name}}</h6>
                            
                          
                            <div class="switch">
                            <label>
                              Off
                              <input type="checkbox"  id='{{$category->id}}' ng-click="set_notification({{$category->id}})" @if($category->status=='true' && $category->user_id==Auth::user()->id) checked="checked" @endif  >

                              <span class="lever"></span>
                              On
                            </label>
                           
                          </div></div>
                          
                          @endforeach

                          
                          </div>
                          <div class='row text-center'>
                           <a class="btn btn-info waves-effect waves-light" href="{{ URL::previous() }}">Done</a>
                           </div>

             
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>
  <script type="text/javascript">

   var app = angular.module('create_notification', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('NotificationCtrl', function($scope, $http) {
    $scope.array=[];
    

     $scope.set_notification= function(id)
     {
      
      status=$('#'+id).is(':checked');
    
        
       $http.get("{{url('set_notification')}}"+'/'+id+'/'+status)
      .success(function(response) {console.log(response);});
      console.log(id+' '+status);
     }
    
     
  });



  </script>
@endsection
