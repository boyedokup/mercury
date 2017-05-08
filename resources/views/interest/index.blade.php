@extends('layouts.dashboard')

@section('content')
<div class="">
    <div class="row text-center col-md-12">
        

         <div class="col-md-9 col-sm-12   text-center pull-left">
        
         <div class="col-md-12">
            <div class="card-panel blue">
                <span class="white-text"> These are applications you are interested in and might apply to.
          </span>
            </div>
        </div>

           

<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-pills pills-primary" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" data-toggle="tab" href="#panel21" role="tab"> Saved Proposal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel22" role="tab"> Saved Tender</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel23" role="tab"> Save Quotation</a>
            </li>
        </ul>
    </div>

    <div class="col-md-9 col-sm-12 col-xs-12">
        <!-- Tab panels -->
        <div class="tab-content vertical">

            <!--Panel 1-->
            <div class="tab-pane fade in active" id="panel21" role="tabpanel">
  
            @if(count($proposals)==0)
               <h5>No saved Proposal Application yet </h5>
               @endif
              
              @foreach($proposals as $proposal)
        <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countp % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countp % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$proposal->proposal->submission_closing_date->toFormattedDateString()}} </span> </div>

              @if(Carbon\Carbon::now() > $proposal->proposal->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else
            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$proposal->proposal->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>
            @endif

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
               <!-- empty space -->
            
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$proposal->proposal->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$proposal->proposal->scope_description}} </div>
                    
                          
              
                </div>

                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("proposal",$proposal->proposal->id)}}'">More</button>

               

                <a class='pull-right ' href="#"> GHS {{$proposal->proposal->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$proposal->proposal->region}} {{$proposal->district}} </a>
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
               <h5>No saved Tender Application yet </h5>
               @endif

            @foreach($tenders as $tender)

           <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countt % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countt % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$tender->tender->submission_closing_date->toFormattedDateString()}} </span> </div>
             

              @if(Carbon\Carbon::now() > $tender->tender->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else

            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$tender->tender->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>
             @endif

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
            <!-- empty space -->
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$tender->tender->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$tender->tender->scope_description}} </div>
                    
                          
              
                </div>
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("tender",$tender->tender->id)}}'">More</button>

               

                <a class='pull-right ' href="#"> GHS {{$tender->tender->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$tender->tender->region}} {{$tender->tender->district}} </a>
                </div>

                
                <span class=" text-center col-md-1 col-sm-12 grey-text  text-darken-2">Tenderer:{{$tender->user->company->company_registered_name}} </span>
                      

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
               <h5>No saved Quotation Application  yet </h5>
               @endif


              @foreach($quotations as $quotation)

           <div class="row ">
        <div class="col-md-12 col-sm-12" >
            <div class="card  @if($countq % 2==0) blue white-text @else blue-text text-darken-1  offwhite @endif" >

               <div class="col-md-2 col-sm-12 avatar hidden-md-down logo  @if($countq % 2==0)  blue-text white @else  blue    white-text text-darken-1 @endif"> <img  style='margin-left: auto;margin-right:auto' src="{{asset('client_logos/gov.png')}}" class="img-circle img-responsive "></div>

               <div class="col-md-10">
                <div class="card-content  text-left">
            
                <div class="row col-md-12 col-sm-12">            
            <div class=" row text-left   col-md-7 col-sm-6 pull-left "> <span class="">  <i class="fa fa-calendar" aria-hidden="true"></i> {{$quotation->quotation->submission_closing_date->toFormattedDateString()}} </span> </div>

             @if(Carbon\Carbon::now() > $quotation->quotation->submission_closing_date )
              <div class="row text-right badge red col-md-2 col-sm-3  pull-right"> <span >Closed</span> </div>
              @else

            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$quotation->quotation->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>

            @endif

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
            <!-- empty space -->
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$quotation->quotation->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$quotation->quotation->scope_description}} </div>
                    
                          
              
                </div>
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("quotation",$quotation->quotation->id)}}'">More</button>

               

                <a class='pull-right ' href="#"> GHS {{$quotation->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$quotation->quotation->region}} {{$quotation->quotation->district}} </a>
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
      
      @if(!Auth::check())
      <h4 class='h4-responsive text-center'>Testimomies</h4>
      <a class="btn btn-primary btn-rounded " href="{{url('register')}}">Get Started</a>
     <div class="row">
    <div class="col-md-12">

     <!--    <div class="card-panel">
         CEO
         <hr>
            <span class="blue-text text-darken-2">Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-panel">
        PROCUREMENT MANAGER
        <hr>
            <span class="blue-text text-darken-2">Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card-panel">
         COO
         <hr>
            <span class="blue-text text-darken-2">Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</span>
        </div>
    </div> -->
        @else
         <h4 class='h4-responsive text-center'>Advertise</h4>
      <a class="btn btn-primary btn-rounded ">Create Ad</a>
      <!--  <div class="col-md-12">
                
                <div class="card">
                    <div class="card-image">
                        <div class="view overlay hm-white-slight z-depth-1">
                            <img src="http://mdbootstrap.com/images/reg/reg%20(1).jpg">
                            <div class="mask waves-effect activator"></div>
                        </div>
                    </div>
                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">Click on image to see the effect<i class="material-icons right">more_vert</i></span>
                        <p><a>This is a link</a></p>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                        <p>Lorem ipsum dolor sit amet enim. Etiam ullamcorper. Suspendisse a pellentesque dui, non felis. Maecenas malesuada elit lectus felis, malesuada ultricies. Curabitur et ligula.</p>
                    </div>
                </div>

            </div> -->


        @endif
     </div>     

    </div>
    

</div>    

    </div>
    
    

</div>
<style type="text/css"> 
.nav-tabs
{
box-shadow:none;
}
</style>
@endsection
