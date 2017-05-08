@extends('layouts.dashboard')
@section('content')
<div class='row' ng-app='rfi' ng-controller='RFICtrl'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
      <div class="card hoverable">

          <div class="card-content">
           <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
            <h5 class='blue-text'> Reply:{{$application->name}}</h5>
              <div class='text-center'>
              @if(count($requests)==0)
                 <h4> No RFIs yet</h4>
              @endif
               @foreach($requests as $request)

                 {{$request->message}}
                 <br>
                 @if($request->status=='request')
                   <a class="btn btn-info waves-effect waves-light "  data-toggle="modal" data-target="#reply" ng-click="select_rfi('{{$request->id}}','{{$request->message}}')">Reply </a>
                  @else
                    <a class="btn btn-info waves-effect waves-light  disabled" >Sent </a>
                    @endif
                 <hr>
               @endforeach
               </div>
      </div>
    </div>
  </div>




<!-- Modal -->
<div class="modal fade" id="reply" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Reply</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
            <div class='row'>
            {!! Form::open(array('url' => 'reply_rfi','method'=>'post','files'=>'true')) !!}
                       {!! Form::token() !!}

                       <div class="row">
                        <p class="text-center"> <% message %></p>
                       </div>
                     
                       <div class='input-field'>
                {!!Form::textarea('message',null,["class"=>"materialize-textarea"])!!}
                <label for="scope_description">Message:<span class='red-text text-darken-1'>{{$errors->first('message')}}</span></label>

                </div>

                   <input type='hidden' name='reference_id' value='{{$application->id}}' >
                    <input type='hidden' name='id' value='<% id %>' >
                          
                          </div>
        
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">

              <button type="submit" id='reply' class="btn btn-primary btn-md waves-effect waves-light btn-rounded" >Send Reply</button>
                 
               {!! Form::close() !!}
              
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->

</div>

 <script type="text/javascript">

   var app = angular.module('rfi', [], function($interpolateProvider) {
          $interpolateProvider.startSymbol('<%');
          $interpolateProvider.endSymbol('%>');
      });

   app.controller('RFICtrl', function($scope, $http) {
    $scope.array=[];
    

     $scope.select_rfi= function(id,message)
     {
       
     $scope.id=id;
     $scope.message=message;
     console.log(id);

     
     }

     
  });



  </script>
@endsection
