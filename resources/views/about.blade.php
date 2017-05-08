@extends('layouts.dashboard')

@section('content')
<div class='row'>
<div class='col-md-3  col-md-offset-1'>
<div id="fixed-sidebar" data-spy="affix" data-offset-top="195">
                   <nav class="scrollspy hidden-xs hidden-sm" id="scrollspy">
                        <ul class="nav nav-pills nav-stacked tabs">
                          
                            <li><a href="#section1"><h6>Tenderbox </h6></a></li>
                            <li><a href="#section2"><h6>Features</h6></a></li>
                            <li><a href="#section3"><h6>Pricing And Cashout</h6></a></li>      
                            <li><a href="#section4"><h6>Terms And Conditions</h6></a></li>
                        </ul>
                    </nav>

               
                </div> 
                      </div>
                              <div class='col-md-7 pull-left'>
					              <div id="section1">    
					        <h4>Tenderbox</h4>
					        <p>Electronic Tendering app that facilitates most processes of traditional tendering.
                  This includes <b>Call For Proposal, Call For Quotation and Invitation to Tender</b>
                 <br>
                     Tenderbox manages all tenders created, published and submitted in one box.
                      Even to the extent of helping to easily review documents and selection of qualified tenders<br>
                   
                
                   Tenderbox differenciates itself by pushing published tenders to revelant and targeted group of clients.
                     
                   <br>
                
                     Tenderbox gives applicants the ease of making payments electronically and smoother client interaction
                   
                  
                  </p>

                 
					</div>
					<div id="section2">    
					        <h4>Features</h4>
					        <p>Tenderbox was created with the user at heart. Most of the functions are just what the user needs.

                 <br>
                 
                     1)Creat, Publish and Apply for tenders from anywhere with internet access<br>
                   
                
                  2)Pay for tenders electronically  via debits cards and mobile money
                     
                   <br>
                
                  3) Send RFI's from the same portal and receive notications within the shortest possible time
                     <br>

                  4) Easily view submitted documents and select tenders for further processing.
                  <br>
                  5)Customisable Notification and Alert settings
                  <br>
                  6)Receive alerts for newly Published Tenders

                   
                  
                  </p>
					</div>
					<div id="section3">    
					        <h4>Pricing And Cashouts</h4>
					        <p>Everthing is free. We just charge 7% of the total sale of Tender Documents paid through our platform
                  <br>
                  Clients receive revenue from sale of tender documents at most 3 days after request.

                  </p>
					</div>
					
					<div id="section4">    
					        <h4>Terms And Conditions</h4>
					        <p>
               

                  </p>
					</div>
     </div>
@endsection
@section('footer')
<div class="affix-end"></div>

<footer class="page-footer blue center-on-small-only row col-md-12 col-sm-12 pull-left stylish-color-dark" style="margin:0px;padding:0px">

  <!--Copyright-->
    <div class="footer-copyright">
        <div class="container-fluid">
         © 2016 Copyright<span class='pull-right' >Powered by Boyedees</span>

        </div>
    </div>
    <!--/.Copyright-->

</footer>
<!--/.Footer-->

<script type="text/javascript">

        $('#fixed-sidebar').affix({
            offset: {
                top: 0,
                bottom: ($('footer').outerHeight(true) + $('.affix-end').outerHeight(true)) + 30
            }
        });
    
</script>
<style type="text/css">
.nav-tabs
{
box-shadow:none;
}
	.affix-top {
  position: relative;
  top: 0px;
  width: 150px;
}

.affix {
  top: 170px;
}

.affix,
.affix-bottom {
  width: 150px;
}

.affix-bottom {
  position: absolute;
}

.affix-end {
  height: 10px;
}

#fixed-sidebar .card-panel {
  margin-top: 0;
}

@media only screen and (max-width: 1200px) {
  #fixed-sidebar {
    display: none;
  }
}

@media only screen and (min-width: 1200px) {
  #mobile-sidebar {
    display: none;
  }
}

@media only screen and (max-width: 1450px) {
  .affix-top,
  .affix,
  .affix-bottom {
    width: 300px;
  }
}
</style>
@endsection