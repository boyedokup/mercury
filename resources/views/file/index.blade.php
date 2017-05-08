@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                    <div class="card-content">
                        <h5 class='blue-text'>Profile</h5>
                         <div  class='col-md-10 col-md-offset-1'>
                    
             <form action="{{url('file')}}" class="dropzone" id="my-awesome-dropzone" method='post' enctype="multipart/form-data">

                     {{ csrf_field() }}

                     </form>
                     </div>

                    
                        
              <!--/.Buttons-->
          </div>
          <!--Image Card-->

      </div>
    </div>

  </div>
  <script type="text/javascript">
    

    Dropzone.options.myAwesomeDropzone = {
  init: function() {
    this.on("addedfile", function(file) { console.log(file.size+"Added file."); });
  }
};
  </script>
@endsection
