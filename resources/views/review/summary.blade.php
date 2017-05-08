@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='set_permission' ng-controller='PermissionCtrl'>
<div class="col-md-8 col-md-offset-2 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                    <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                    <h5 class='blue-text text-center'>{{$submission->company->company_registered_name}}</h5>
                    <h5 class='text-center'>Summary</h5>

                       <div class='row col-md-12'>

                       <table class="col-md-12 row border" >
                       <th class="text-center">Rubric </th>
                       <th class="text-left">Weight </th>
                       <th class="text-center"> Rate </th>
                       <th class="text-center">Remarks </th>

                       @foreach($reviews as $review)
                        <tr>
                          <td class="col-md-4">{{$review->criteria->rubric}}  </td>
                          <td class="col-md-2">{{$review->criteria->weight}}% </td>
                  
                        <td class="col-md-2 text-center"> {{$review->rate}} % </td>

                            <td class="col-md-4"> 
                          
                            {{$review->comment}}                        

                            </td>
                        </tr> 
                        
                       
                       @endforeach

                       </table>
                        
                        
                      
                     

                   
           <!--Buttons-->
              <div class="card-btn text-center">
                       
               </div>
              <!--/.Buttons-->
            </div>


          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>
  <script type="text/javascript">

   var app = angular.module('set_permission', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('PermissionCtrl', function($scope, $http) {
    $scope.array=[];


     $scope.set_vend_permission= function(id)
     {

      status=$('#'+id).is(':checked');

       $http.get("{{url('api/set_vendor_perm')}}"+'/'+id+'/'+status+'/'+"{{$permission->vendor_staff_perm_id}}")
      .success(function(response) {console.log(response);});

     }


  });



  </script>


@endsection
