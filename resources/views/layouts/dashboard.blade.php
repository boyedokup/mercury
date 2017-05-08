<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> TendorBox</title>

   
    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    
  <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" >


    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.css')}}" rel="stylesheet">

    <!-- DropZone -->
    <link href="{{asset('css/dropzone.css')}}" rel="stylesheet">

 
    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Material Design Bootstrap -->
    <script type="text/javascript" src="{{asset('js/mdb.js')}}"></script>

    <!--AngularJS -->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>

   <!--dropZone -->
   <script src="{{asset('js/dropzone.js')}}"></script>
      <style>

         body {
            
           font-family: 'Lato', sans-serif;
           text-align: justify-all;
           height: 100%;

         }

         .card
         {
           font-family: 'Lato', sans-serif;
           text-align:left;
           height: 100%;

         }

         .card .card-action a
         {
          color: inherit;
          font-size: 12px;
          padding: 0px;
         }

         .card .card-action 
         {
         
          padding-bottom: 0px;
         }

         p
         {
          font-size: inherit;
         }

         .btn-default {
         line-height:inherit;
         bottom: 20px;
        
         }

         .top-nav-collapse {
             background-color: #3F729B !important;
             margin: 0px;
         }
         /* Small Devices, Tablets */

         @media only screen and (max-width: 768px) {
             .navbar {
                 background-color: #3F729B !important;
                 margin:0px;
             }
         }
         nav
         {
          margin: 0px;
         }


        .dropzone{
        border: 2px dashed #0087F7;
       }

       .card .card-btn {
        border-top: 0px;
       }
      
       .dl-horizontal dt
       {
        overflow:inherit;
        text-align: left;
       }

       .collection .collection-item
       {
        padding: 20px;
       }


       .dl-horizontal dd{
       
        text-align:justify;
       }

       @media (min-width: 768px)
     {
     .dl-horizontal dd {
    margin-left: 180px;
    bottom: 20px;
    text-align: justify;
     }

   }

      @media (max-width: 768px)
     {
    
     .img-circle
     {

      width: 50%;
     }

     .card .logo
     {
      min-height:0px;
      width: 100%;
     }

   }

       .logo
       {
    display: -webkit-flex;
    display: flex;
    -webkit-align-items: center;
    align-items: center;
    vertical-align:center;
    min-height:220px;
    height: auto;
    background-color: lightgrey;
    text-align: center
    width:100px;
   
       }
     
    .popup .dropdown-menu li > a, .dropdown-menu li > span
     {
     
      padding: 0rem 0rem;
      text-align: center;
      border-radius: 5px;
    
     }
    
    .dropdown-menu{
      right: 0;
      left: inherit;

    }


     </style>


   <script>
     $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    // Initialize collapse button
    $(".button-collapse").sideNav();
    // Initialize collapsible (uncomment the line below if you use the dropdown variation)
    $('.collapsible').collapsible();
    $('select').material_select();

    $('.datepicker').pickadate({
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year
    format: 'yyyy-mm-dd'
  });

  $('#input_starttime').pickatime({
    twelvehour: false,
    clear:true
  });

   $('.popover-dismiss').popover({
  trigger: 'focus'
})


  $('[data-toggle="popover"]').popover

  $('.carousel').carousel();

  $('[data-toggle="tooltip"]').tooltip({animation: true, delay: {show: 300, hide: 300}}); 

  });

 

</script>
 </head>
<body data-spy="scroll">


    <!--Navigation-->
    <nav class="navbar fixed-top navbar-toggleable-md scrolling-navbar  green darken-3" style="margin: 0px">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- <a class="navbar-brand waves-effect waves-light" href="{{url('/')}}" style="bottom:10px"> 
                        <img src="{{asset('images/logo.png')}}" width="200px" height="auto" ></a> -->
                        <a href="{{url('/')}}"><h5> GOG E-Procure </h5></a>
                    </div>

                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                        <ul class="nav navbar-nav navbar-right">

                              
                              @if(Auth::check())
                             
                             @if(Auth::user()->role !='Board')
                              <li><a href="{{url('proposal/create')}}">New Proposal</a></li>
                              <li><a href="{{url('tender/create')}}">New Tender</a></li>
                              <li><a href="{{url('quotation/create')}}">New Quotation</a></li>
                              <li><a href="{{url('application')}}">Applications</a></li>                         

                             
                              <li><a href="{{url('notification')}}">Alerts</a></li>
                              <li><a href="{{url('interest')}}">Favorites </a></li>
                              <li><a href="{{url('submission')}}">Submissions</a></li>
                             <li><a href="{{url('board')}}">Board</a></li>
                               <li><a href="{{url('user')}}">Users</a></li>
                               
                                @endif

                             
                              
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle waves-effect waves-light" data-toggle="dropdown" role="button" aria-expanded="false">{{Auth::user()->name}} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                     <li><a href="{{url('user/'.Auth::user()->id.'/edit')}}">User Profile</a></li>
                                     <li><a href="{{url('company/'.Auth::user()->company_id.'/edit')}}">Company Profile</a></li>
                                     <li><a href="{{url('logout')}}">Log Out</a></li>

                                </ul>
                            </li>

                            @else
                            <li><a href="">support@tenderbox.com</a></li>
                            <li><a href="http://159.203.179.183/gs/">About</a></li>
                              <li><a href="{{url('login')}}">Log In</a></li>
                              <li><a href="{{url('register')}}">Sign Up</a></li>
                              

                            @endif
                        </ul>

                    </div>
                </div>
            </nav>
<!--/.Navigation-->

        <div class="col-md-12" style="margin: 0px;padding: 0px">  <img src="{{asset('images/banner.png')}}" width="100%" style="margin: 0px;padding: 0px"></div>
      @yield('content')
      @yield('footer')

     
       

      <script>

        var opts = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-right",
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
        };
        </script>
      @if (Session::get('success'))
        <script type="text/javascript">
        toastr.success("{{Session::get('success')}}",null, opts);
        </script>
     @endif

     @if (Session::get('status'))
        <script type="text/javascript">
         toastr.success("{{Session::get('status')}}",null, opts);
        </script>
      @endif

   @if (Session::get('fail'))
        <script type="text/javascript">
        toastr.error("{{Session::get('fail')}}",null, opts);
        </script>
   @endif

   @if (Session::get('info'))
        <script type="text/javascript">
        toastr.info("{{Session::get('info')}}",null, opts);
        </script>
   @endif

 <script type="text/javascript">
    
    Dropzone.options.myAwesomeDropzone = {
    addRemoveLinks:true,
    paramName:"file",
     init: function() {
    this.on("removedfile", function(file) 
      { 
          $.get("{{url('delete_file')}}"+"/"+file.name, function(data, status){
           

          });
      });
  }
  
};


  </script>

    </body>
  </html>
