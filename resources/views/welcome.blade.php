@extends('layouts.dashboard')

@section('content')
<div class="">
    <div class="row text-center col-md-12">
        
        
         <div class="col-md-9 col-sm-12   text-center pull-left">
        
        @if(Auth::check())
        @if(Auth::user()->company->verified !='Yes')
         <div class="col-md-12">
            <div class="card-panel blue">
                <span class="white-text"> Please update your <a href="{{url('company/'.Auth::user()->company_id.'/edit')}}" class="black-text">Company Profile  </a> to be verified. You cannot 
                publish or apply for any Tender without verification.
          </span>
            </div>
        </div>
          @endif
          @else
         <div class='col-md-12' style='margin-bottom:10px'>
          
          <!--<div class='col-md-2 col-sm-2'>
          <img src="{{asset('client_logos/forbes.png')}}" width='100px'>
          </div>
          <div class='col-md-2 col-sm-2'>
          <img src="{{asset('client_logos/rework_logo_.jpg')}}" width='100px' >
          </div>
          <div class='col-md-2 col-sm-2'>
          <img src="{{asset('client_logos/CNN_Logo.png')}}" width='100px' >
          </div>
          <div class='col-md-2 col-sm-2'>
          <img src="{{asset('client_logos/TED.jpg')}}" width='100px' >
          </div>
          <div class='col-md-2 col-sm-2'>
          <img src="{{asset('client_logos/rework_logo_.jpg')}}" width='100px' >
          </div>-->
          </div> 
             
         @endif


<div class="row">
    <div class="col-md-3 col-sm-12 col-xs-12">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs md-pills pills-primary" role="tablist">
            <li class="nav-item active">
                <a class="nav-link" data-toggle="tab" href="#panel21" role="tab"> Call For Proposal</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel22" role="tab"> Invitation To Tender</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel23" role="tab"> Call For Quotation</a>
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


            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$proposal->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
               <!-- empty space -->
            
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$proposal->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$proposal->scope_description}} </div>
                    
                          
              
                </div>

                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("proposal",$proposal->id)}}'">More</button>

               

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
               <h5>No  Tenders  yet </h5>
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


            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$tender->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
            <!-- empty space -->
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$tender->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$tender->scope_description}} </div>
                    
                          
              
                </div>
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("tender",$tender->id)}}'">More</button>

               

                <a class='pull-right ' href="#"> GHS {{$tender->price}}.00 </a>
                   
              
              <a class='pull-right' href="#"><i class="fa fa-location-arrow" aria-hidden="true"></i> {{$tender->region}} {{$tender->district}} </a>
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


            <div class="row text-right badge green col-md-1 col-sm-3  pull-right"> <span >{{$quotation->submission_closing_date->diffInDays(Carbon\Carbon::now())}}d</span> </div>

              <div class="dropdown text-left col-md-4 col-sm-3 pull-right">
            <!-- empty space -->
              </div>  
            
            </div>

       
          
             <div class="row text-uppercase text-justify col-md-12 col-sm-12  col-xsm-12 pull-left"><b> {{$quotation->name }} </b></div> 
             
           <div class=" row text-left col-md-12 col-sm-12 text-justify  pull-left">{{$quotation->scope_description}} </div>
                    
                          
              
                </div>
                <div class=" row card-action  col-md-12 col-sm-12  pull-left">

                <button class="btn btn-default waves-effect waves-light btn-rounded pull-left" onclick="window.location='{{url("quotation",$quotation->id)}}'">More</button>

               

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

    


    
     <div class='col-md-3 col-sm-12 pull-right text-center hidden-md-down'>
      
     <!--  <h4 class='h4-responsive text-center  hidden-xl-down'>Advertise</h4>
      <a class="btn btn-primary btn-rounded ">Create Ad</a> -->
      
      <!-- Carousel -->
    <div id="carousel-multi-item" class="carousel slide multiitem-car " data-interval="5000" id='carousel'>
        <div class="text-center">
            <a class="btn-floating btn-small waves-effect waves-light grey darken-4" href="#carousel-multi-item" role="button" data-slide="prev"><i class="material-icons">keyboard_arrow_left</i></a>
            <a class="btn-floating btn-small waves-effect waves-light grey darken-4" href="#carousel-multi-item" role="button" data-slide="next"><i class="material-icons">keyboard_arrow_right</i></a>
        </div>
        <!-- Indicators -->
        <ol class="carousel-indicators">
      <li data-target="#carousel-multi-item" data-slide-to="0" class="active"></li>
            <li data-target="#carousel-multi-item" data-slide-to="1"></li>
            
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner">


            <!-- First slide -->
            <div class="item active">

                <!-- Row -->
                <div class="row text-center">
                    <!-- Card -->
                    <div class="col-sm-12 item-card">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa1.png')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->

                    <!-- Card -->
                    <div class="col-sm-12 item-card  hidden-xs">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa2.png')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->

                    <!-- Card -->
                    <div class="col-sm-12 item-card  hidden-xs">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa3.jpg')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.item -->

            <!-- Second slide -->
            <div class="item">
                <!-- Row -->
                <div class="row text-center">
                    <!-- Card -->
                    <div class="col-sm-12 item-card">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa4.png')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->

                    <!-- Card -->
                    <div class="col-sm-12 item-card hidden-xs">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa5.png')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->

                    <!-- Card -->
                    <div class="col-sm-12 item-card hidden-xs">
                        <!--Image Card-->
                        <div class="card hoverable">
                            <div class="card-image">
                                <div class="view overlay hm-white-slight z-depth-1">
                                    <img src="{{asset('images/ppa6.png')}}" class="img-responsive" alt="">
                                    <a href="#">
                                        <div class="mask waves-effect"></div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-content">
                                <h5>Card title</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur excepturi quas sint inventore itaque repudiandae libero atque. </p>
                            </div>
                            <!--Buttons-->
                            <div class="card-btn text-center">
                                <a href="#" class="btn btn-primary btn-md waves-effect waves-light">Read more</a>
                            </div>
                            <!--/.Buttons-->
                        </div>
                        <!--Image Card-->
                    </div>
                    <!-- /.Card -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.item -->


        </div>
        <!-- /.carousel-inner -->

    </div>
    <!-- /.carousel -->
        

    


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

@section('footer')

<!-- <footer class="page-footer blue center-on-small-only row col-md-12 col-sm-12 pull-left stylish-color-dark" style="margin:0px;padding:0px">

    <div class="footer-copyright">
        <div class="container-fluid">
         © 2016 Copyright<span class='pull-right' >Powered by Boyedees</span>

        </div>
    </div>
  

</footer> -->



@endsection