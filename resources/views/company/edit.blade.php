@extends('layouts.dashboard')
@section('content')
<div class='row'>
<div class="col-md-6 col-md-offset-3 col-sm-12">
                <!--Image Card-->
                <div class="card hoverable">

                <div class="card-content">
                 <a href="{{ URL::previous() }}" class=''><i class="fa fa-arrow-left fa-2x" aria-hidden="true"></i></a>
                    <h5 class='blue-text'>Company Profile</h5>
                    {!! Form::model($company, array('route' => array('company.update',$company->id),'method'=>'put','files'=>true)) !!}
                       {!! Form::token() !!}
                

                <div class='input-field'>
                   {!! Form::text('company_registered_name') !!}
                <label for="name" >Company Registered Name:<span class='red-text text-darken-1'>{{$errors->first('company_registered_name')}}</span></label>
               
                </div>

                <div class='input-field'>
                {!!Form::textarea('company_description',null,["class"=>"materialize-textarea"])!!}
                <label for="company_description">Company Description:<span class='red-text text-darken-1'>{{$errors->first('company_description')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::email('email') !!}
                <label for="email">Company Email:<span class='red-text text-darken-1'>{{$errors->first('email')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('contact') !!}
                <label for="contact">Contact:<span class='red-text text-darken-1'>{{$errors->first('contact')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('building_name') !!}
                <label for="building_name">Building Name:<span class='red-text text-darken-1'>{{$errors->first('building_name')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('landmark') !!}
                <label for="landmark">Landmark:<span class='red-text text-darken-1'>{{$errors->first('landmark')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('postal_address') !!}
                <label for="postal_address">Postal Address:<span class='red-text text-darken-1'>{{$errors->first('postal_address')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('area') !!}
                <label for="area">Area:<span class='red-text text-darken-1'>{{$errors->first('area')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('city') !!}
                <label for="city">City:<span class='red-text text-darken-1'>{{$errors->first('city')}}</span></label>

                </div>
                <div class='input-field'>
                   {!! Form::text('country') !!}
                <label for="country">Country:<span class='red-text text-darken-1'>{{$errors->first('country')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('country_of_registration') !!}
                <label for="country_of_registration">Country Of Registration:<span class='red-text text-darken-1'>{{$errors->first('country_of_registration')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::select('month_of_registration',['Jan'=>'January','Feb'=>'February','Mar'=>'March','Aprl'=>'April','May'=>'May','June'=>'June','July'=>'July','Aug'=>'August','Sept'=>'September','Oct'=>'October','Nov'=>'November','Dec'=>'December'], null, ['placeholder' => 'Select Month...']) !!}
                <label for="month_of_registration">Month Of Registration:<span class='red-text text-darken-1'>{{$errors->first('month_of_registration')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('year_of_registration') !!}
                <label for="year_of_registration">Year Of Registration:<span class='red-text text-darken-1'>{{$errors->first('year_of_registration')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('registration_ID') !!}
                <label for="registration_identification_number">Registration Identification Number:<span class='red-text text-darken-1'>{{$errors->first('registration_ID')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::text('tin') !!}
                <label for="tin">TIN:<span class='red-text text-darken-1'>{{$errors->first('tin')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::select('organizational_type',['Partnership'=>'Partnership','Limited by Guarantee'=>'Limited by Guarantee','Limited by Liability'=>'Limited by Liability','Entreprise'=>'Entreprise','Venture'=>'Venture','Incorporated'=>'Incorporated'], null) !!}
                <label for="organizational_type">Organizational Type:<span class='red-text text-darken-1'>{{$errors->first('organizational_type')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('number_of_employees') !!}
                <label for="number_of_employees">Number Of Employees:<span class='red-text text-darken-1'>{{$errors->first('number_of_employees')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('share_gh_employees') !!}
                <label for="share_gh_employees">Percentage Of Ghanaian Employees:<span class='red-text text-darken-1'>{{$errors->first('share_gh_employees')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('share_gh_manager') !!}
                <label for="share_gh_manager">Percentage Of Ghanaian Managers:<span class='red-text text-darken-1'>{{$errors->first('share_gh_manager')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('share_gh_directors') !!}
                <label for="share_gh_directors">Share Of Ghanaian Directors:<span class='red-text text-darken-1'>{{$errors->first('share_gh_directors')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::select('has_local_content',['Yes'=>'Yes','No'=>'No'], null) !!}
                <label for="has_local_content">Do you have local content:<span class='red-text text-darken-1'>{{$errors->first('has_local_content')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('gh_ownership_percentage') !!}
                <label for="gh_ownership_percentage">Percentage Of Ghanaian Ownership:<span class='red-text text-darken-1'>{{$errors->first('gh_ownership_percentage')}}</span></label>

                </div>

                <div class='input-field'>
                   {!! Form::number('annual_turnover') !!}
                <label for="annual_turnover">Annual Turnover:<span class='red-text text-darken-1'>{{$errors->first('annual_turnover')}}</span></label>

                </div>

               <div class="file-field">
                  <div class="btn btn-primary">
                    <span>Upload Company Logo</span>
                   {!!  Form::file('logo_url') !!}
                  </div>
                  <div class="file-path-wrapper">
                   <input class="file-path validate" type="text" placeholder=" {{$company->logo_url}}" >
                  </div>
                  </div>

                  <button type="button" class="btn btn-primary btn-lg btn-block" data-toggle="modal" data-target="#verify">Attach Required Documents</button>
       
              <!--Buttons-->
              <div class="card-btn text-center">
              @if($company->verified=='Yes')
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded">Update</button>
                @else
                <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded" >Verify</button>

              @endif

               </div>{!! Form::close()!!}
              <!--/.Buttons-->
          </div>
          <!--Image Card-->
   

      </div>
    </div>
  </div>

<!-- Modal -->
<div class="modal fade" id="verify" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <!--Content-->
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Attach Documents</h4>
            </div>
            <!--Body-->
            <div class="modal-body">
             <div class='text-center'>
             <h6>Required Documents </h6>
             <ol>
                  
                 <li>Passport/Voters ID/Driver's Lincense</li>
                 <li>Company Certificate</li>
                 <li>Certificate Of Commencement</li>
                 <li> Tax Certificate </li>
            </ol>

             </div>
            <form action="{{url('company_file')}}" class="dropzone" id="my-awesome-dropzone" method='post' enctype="multipart/form-data">

                     {{ csrf_field() }}


           </form>
              <hr>
             <div class='text-center'>
             <h6>Files Attached </h6>
             <ul>
                  @foreach($files as $file)
                 <li><a><i class="fa fa-file-pdf-o" aria-hidden="true"></i> {{$file->url}}</a></li>
                   @endforeach
            </ul>

             </div>
             
            </div>
            <!--Footer-->
            <div class="modal-footer text-center">
               <button type="submit" class="btn btn-primary btn-md waves-effect waves-light btn-rounded"  data-dismiss="modal" >Done</button>
              
            </div>
        </div>
        <!--/.Content-->
    </div>
</div>
<!-- /.Live preview-->
 
 
@endsection
