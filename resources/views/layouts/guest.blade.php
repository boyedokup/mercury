<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenderbox</title>

    <!-- Material Design Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Material Design Bootstrap -->
    <link href="{{asset('css/mdb.css')}}" rel="stylesheet">


    <!-- SCRIPTS -->

    <!-- JQuery -->
    <script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>

    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>

    <!-- Material Design Bootstrap -->
    <script type="text/javascript" src="{{asset('js/mdb.js')}}"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

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
     twelvehour: false
   });


   });


   </script>
 </head>


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


    </body>
  </html>
