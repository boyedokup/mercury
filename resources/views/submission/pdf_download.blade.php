@extends('layouts.guest')
@section('content')

<htmlpageheader name="page-header">
    {{$application->user->company->company_registered_name}} Submission Report 
</htmlpageheader>
<div class='row' >
<div class="col-md-12 col-sm-12  text-center">
                  
                      
                        <h5 class='blue-text text-center'>{{$application->name}} Submissions </h5>
                     
<table class="table table-bordered" style='margin:10px'>
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Company</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Qualified</th>
        </tr>
    </thead>
    <tbody style="border:solid 1px;margin:10px">
    @foreach($submissions as $submission)
        <tr>
            <th scope="row">{{$count=$count+1}}</th>

            <td>{{$submission->user->name}}</td>
             <td>{{$submission->user->company->company_registered_name}}</td>
              <td>{{$submission->user->contact}}</td>
               <td>{{$submission->user->email}}</td>

          
           
            <td>
               @if($submission->selected=='true')
               Yes
               @else
               No
               @endif
            </td>
            
        </tr>
    
        @endforeach
        
    </tbody>
</table>
   
               
             
             
    </div>
 

  
  </div>

  <htmlpagefooter name="page-footer">
    {PAGENO}
  </htmlpagefooter>
  <style>
  @page {
      header: page-header;
      footer: page-footer;
  }
  </style>

@endsection
