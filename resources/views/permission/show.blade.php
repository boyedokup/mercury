@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app="permission" ng-controller="PermissionCtrl">
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                    <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>

           <h5 class='blue-text text-center'>Set Permission : {{$permission->user->name}} </h5>
            
               <div class="row">
            
            
              <div class='col-md-6'><label> Can Create User </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_monitor' ng-click="set_permission('can_monitor')" @if($permission->can_monitor ==1) checked='checked' @endif >

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>


              <div class="row">
            
              <div class='col-md-6'><label> Can Edit User </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                         <input type="checkbox"  id='can_switch_on' ng-click="set_permission('can_switch_on')" @if($permission->can_switch_on ==1) checked='checked' @endif >

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               <div class="row">
            
              <div class='col-md-6'><label> Can Change Permission </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_cashier' ng-click="set_permission('can_create_cashier')" @if($permission->can_create_cashier ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>


              <div class="row">
            
              <div class='col-md-6'><label> Can Create Tender </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_view_users' ng-click="set_permission('can_view_users')" @if($permission->can_view_users ==1) checked='checked' @endif >

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               <div class="row">
            
              <div class='col-md-6'><label> Can Edit Tender </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_edit_users' ng-click="set_permission('can_edit_users')" @if($permission->can_edit_users ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

              <div class="row">
            
              <div class='col-md-6'><label> Can Publish Tender </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_cashier' ng-click="set_permission('can_create_cashier')" @if($permission->can_create_cashier ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               

               <div class="row">
            
              <div class='col-md-6'><label> Can Review Tender </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_view_payments' ng-click="set_permission('can_view_payments')" @if($permission->can_view_payments==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               

               <div class="row">
            
              <div class='col-md-6'><label> Can Reply RFI </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                     <input type="checkbox"  id='can_create_subscriptions' ng-click="set_permission('can_create_subscriptions')"  @if($permission->can_create_subscriptions ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               <div class="row">
            
              <div class='col-md-6'><label> Can View Submission</label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                   <input type="checkbox"  id='can_edit_subscriptions' ng-click="set_permission('can_edit_subscriptions')"  @if($permission->can_edit_subscriptions ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>
             
             <div class="row">
            
              <div class='col-md-6'><label> Can Add Criteria </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_cashier' ng-click="set_permission('can_create_cashier')" @if($permission->can_create_cashier ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

              <div class="row">
            
              <div class='col-md-6'><label> Can Add Reviewer </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_cashier' ng-click="set_permission('can_create_cashier')" @if($permission->can_create_cashier ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

               <div class="row">
            
              <div class='col-md-6'><label> Can Change Alert </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_clients' ng-click="set_permission('can_create_clients')" @if($permission->can_create_clients ==1) checked='checked' @endif >

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>

              

               <div class="row">
            
              <div class='col-md-6'><label> Can Save Favorites </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                              <input type="checkbox"  id='can_create_cashier' ng-click="set_permission('can_create_cashier')" @if($permission->can_create_cashier ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>
              
              <div class="row">
            
              <div class='col-md-6'><label> Can RFI </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                        <input type="checkbox"  id='can_view_subscriptions' ng-click="set_permission('can_view_subscriptions')" @if($permission->can_view_subscriptions ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>
             
             <div class="row">
            
              <div class='col-md-6'><label> Can Submit Tender </label></div>
              
              <div class="col-md-6">
              <div class="switch " id='switch'>
                            <label>
                              No
                        <input type="checkbox"  id='can_view_subscriptions' ng-click="set_permission('can_view_subscriptions')" @if($permission->can_view_subscriptions ==1) checked='checked' @endif>

                              <span class="lever"></span>
                              Yes
                            </label>
                           
                          </div>

             </div>             
              </div>
              
                
              <!--Buttons-->
              <div class="card-btn text-center">
                <a class="btn btn-primary btn-md waves-effect waves-light btn-rounded" href="{{url('user')}}">Done</a>


               </div>
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>
  </div>

<script type="text/javascript">

   var app = angular.module('permission', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('PermissionCtrl', function($scope, $http) {



     $scope.set_permission= function(id)
     {
        status=$('#'+id).is(':checked');

        console.log(status + " "+ id);
       $http.get("{{url('api/set_permission')}}"+'/'+id+'/'+status+'/'+'{{$permission->id}}')
       .success(function(response) {console.log(response);});



     }



  });



  </script>


@endsection
