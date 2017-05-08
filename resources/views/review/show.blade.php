@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='set_permission' ng-controller='PermissionCtrl'>
<div class="col-md-8 col-md-offset-2 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                    <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

                    <h5 class='blue-text text-center'>Review {{$tender->company->company_registered_name}}</h5>
                    <h5 class='text-center'>Test</h5>

                       <div class='row col-md-12'>

                       {!! Form::open(array('url' => 'review','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}


                       <table class="col-md-12 row border" >
                       <th class="text-center">Rubric </th>
                       <th class="text-left">Weight </th>
                       <th class="text-center"> Rate </th>
                       <th class="text-center">Remarks </th>

                       @foreach($tender_criterias as $tender_criteria)
                        <tr>
                          <td class="col-md-4">{{$tender_criteria->rubric}}  </td>
                          <td class="col-md-2">{{$tender_criteria->weight}}% </td>
                  

                          <td class="col-md-2">
                           @if($tender_criteria->type=='textbox')
                           <input type="number" name="rate_{{$tender_criteria->id}}"  id='{{$tender_criteria->id}}'   placeholder= 'enter rating' required>
                           @else
                           <div class="text-center">
                          <input type="checkbox" name="rate_{{$tender_criteria->id}}" id='{{$tender_criteria->id}}'>
                           <label for="{{$tender_criteria->id}}"></label>
                           </div>
                           @endif
                            </td>

                            <td class="col-md-4"> 
                          
               
                          <div class="input-field">
                <textarea class="materialize-textarea" name="remarks_{{$tender_criteria->id}}" cols="50" rows="10" placeholder="enter remark" required></textarea>
                          <label for="remarks"><span class="red-text text-darken-1"></span></label>
                         

                          </div>
                        

                            </td>
                        </tr> 
                        
                        <input type="hidden" name="criteria_id[]" value="{{$tender_criteria->id}}">
                       @endforeach

                       </table>
                        
                         <hr></hr>
                       <div class='input-field col-md-12 text-center'>

                    <div class="input-field">

                   {!! Form::text('total_cost',null,['placeholder'=>'Please enter total cost of project']) !!}
                <label for="total_cost">Total Cost:<span class='red-text text-darken-1'>{{$errors->first('total_cost')}}</span>    </label>
                </div>

                      <input type="hidden" name="submission_id" value="{{$submission_id}}">
                       <input type="hidden" name="tender_id" value="{{$tender->reference_id}}">

                   
           <!--Buttons-->
              <div class="card-btn text-center">
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Submit Review</button>
                 
                      
               </div>{!! Form::close()!!}
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
