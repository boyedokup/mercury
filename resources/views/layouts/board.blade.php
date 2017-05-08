<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>TenderBox- Dashboard</title>

<link href="css_dashboard/bootstrap.min.css" rel="stylesheet">
<link href="css_dashboard/datepicker3.css" rel="stylesheet">
<link href="css_dashboard/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js_dashboard/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>

<body>
	<nav class="navbar navbar-inverse navbar-fixed-top nav-green" role="navigation" style="background-color: green">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>GOG E-Procure</span></a>
				@if(Auth::check())

				<ul class="user-menu">
				  <li class="menu-item pull-left" style="margin-right:10px"><a href="{{url('agency')}}">Ministry/Agency </a> </li>
					<li class="dropdown pull-right">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}} <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							

			<li><a href="{{url('user/'.Auth::user()->id.'/edit')}}"> <svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>User Profile</a></li>
                      
             <li><a href="{{url('logout')}}"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg>Log Out</a></li>
						</ul>
					</li>

					
					
				</ul>
				@endif
				
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<form role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="Search">
			</div>
		</form>
		<ul class="nav menu">
			<li class="active"><a href="index.html"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Dashboard</a></li>
			
			@foreach($agencies as $agency)
			<li><a href="#"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> 
			{{$agency->name}}</a></li>
			
			@endforeach
		</ul>
		
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li class="active">Icons</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Dashboard</h1>
			</div>
		</div><!--/.row-->
		
		@yield('content')
		
		
	</div>	<!--/.main-->

	<script src="js_dashboard/jquery-1.11.1.min.js"></script>
	<script src="js_dashboard/bootstrap.min.js"></script>
	<script src="js_dashboard/chart.min.js"></script>
	<script src="js_dashboard/chart-data.js"></script>
	<script src="js_dashboard/easypiechart.js"></script>
	<script src="js_dashboard/easypiechart-data.js"></script>
	<script src="js_dashboard/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
