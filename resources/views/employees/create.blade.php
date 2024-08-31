@extends('master')

@section('title')
Personal Info
@endsection


@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('home')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
           
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Personal Information</h3>
                      </div>
                    <div class="card-body">
                        <form id="memberForm">  
                            
                            <div class="card-body">
                              <div class="form-group">         
                                <img src="{{asset('/uploads/'. $member->profile_pic)}}" alt="&nbsp;no preview&nbsp;" height="auto" width="150px" style="border: 2px solid #000;">
                              </div>

                              <div class="form-group">
                                <label>Image</label>
                                <input type="file" class="form-control" id="profile_pic" name="profile_pic">
                              </div>

                              <div class="row">
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label >Full Name <small style="color: red">*</small></label>
                                  <input type="text" required class="form-control" id="name" name="name" value="{{$user_name}}" >
                                  {{-- <input type="hidden" required class="form-control" id="name" name="name" value="{{$user_name}}" > --}}
                                </div>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label >Designation</label>
                                  <input type="text" required class="form-control" id="designation" name="designation" value="{{$designation_name}}" readonly>
                                </div>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label >Joining Date</label>
                                  <input type="date" required class="form-control" id="joining_date" name="joining_date" value="{{$user_joining_date}}" readonly>
                                </div>
                              </div>
                              </div>
                                                                    
                              <div class="row">
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label >Father's Name <small style="color: red">*</small></label>
                                    <input type="text" required  class="form-control" id="father_name" name="father_name" value="{{$member->father_name}}">
                                  </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label >Mother's Name <small style="color: red">*</small></label>
                                    <input type="text" required class="form-control" id="mother_name" name="mother_name" value="{{$member->mother_name}}">
                                  </div>
                                </div>
                              </div>
                              

                              <div class="row">
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label >Contact Number <small style="color: red">*</small></label>
                                    <input type="text" required class="form-control" id="mobile_number" name="mobile_number" value="{{$member->mobile_number}}">
                                  </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                  <div class="form-group">
                                    <label>NID Number <small style="color: red">*</small></label>
                                    <input type="text" required class="form-control" id="nid_number" name="nid_number" value="{{$member->nid_number}}">
                                  </div>
                                </div>
                              </div>
                                
                              <div class="form-group">
                                <label>Present Address <small style="color: red">*</small></label><br>
                                <textarea required name="present_address" class="summernote" id="present_address">{{$member->present_address}}</textarea>
                              </div>

                              <div class="form-group">
                                <label>Permanent Address <small style="color: red">*</small></label><br>
                                <textarea required name="permanent_address" class="summernote" id="permanent_address">{{$member->permanent_address}}</textarea>
                              </div>

                              <div class="row">
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label >Date of Birth <small style="color: red">*</small></label>
                                    <input required type="date"  class="form-control" id="birth_date" name="birth_date" value="{{$member->birth_date}}">
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label>Blood Group <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="blood_group" name="blood_group" style="width: 100%;">                                  
                                        <option value="{{$member->blood_group}}">{{$member->blood_group}}</option>
                                        <option value="A+">A+</option>
                                        <option value="B+">B+</option>                                
                                        <option value="AB+">AB+</option>                                
                                        <option value="O+">O+</option>                            
                                        <option value="A-">A-</option>
                                        <option value="B-">B-</option>                                
                                        <option value="AB-">AB-</option>                                
                                        <option value="O-">O-</option>                              
                                    </select>
                                </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label>Nationality <small style="color: red">*</small></label>
                                    <input required type="text" class="form-control" id="nationality" name="nationality" value="{{$member->nationality}}">
                                  </div>
                                </div>
                              </div>
                              
                              <div class="row">
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label>Marital Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" name="marital_status" style="width: 100%;" >                                  
                                        <option value="{{$member->marital_status}}">{{$member->marital_status}}</option>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                    </select>
                                  </div>
    
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label>Religion <small style="color: red">*</small></label>
                                    <input required type="text" class="form-control" id="religion" name="religion" value="{{$member->religion}}">
                                  </div>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                  <div class="form-group">
                                    <label>Gender <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="gender" name="gender" style="width: 100%;">                                  
                                        <option value="{{$member->gender}}">{{$member->gender}}</option>
                                        <option value="Male"> Male</option>
                                        <option value="Female">Female</option>                             
                                    </select>
                                  </div>
                                </div>
                              </div>
                      
                            <div class="row">
                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label>Emergency Contact Person Name <small style="color: red">*</small></label>
                                  <input type="text" required  class="form-control" id="emergency_contact_name" name="emergency_contact_name" value="{{$member->emergency_contact_name}}">
                                </div>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label>Emergency Contact Number <small style="color: red">*</small></label>                          
                                  <input type="text" required class="form-control" id="emergency_contact_number" name="emergency_contact_number" value="{{$member->emergency_contact_number}}">                               
                                </div>
                              </div>

                              <div class="col-md-4 col-sm-12">
                                <div class="form-group">
                                  <label>Relation with Emergency Contact Person <small style="color: red">*</small></label>
                                  <input type="text" required class="form-control" id="emergency_contact_relation" name="emergency_contact_relation" value="{{$member->emergency_contact_relation}}">
                                </div>
                              </div>                  
                            </div>
                            <!-- /.card-body -->
                            <button type="submit" class="btn btn-info float-right mr-4">Submit</button>
                          </form>
                    </div>
                    <!-- /.card-body -->
                  </div>
            </div>           
        </div>      
        <br>      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @else
@php
    $redirectRoute = route('login');
    header("Location: $redirectRoute");
        exit();
@endphp
@endif
@endsection

@push('masterScripts')
<script type="text/javascript">

document.getElementById('memberForm').addEventListener('submit',function(event){
  event.preventDefault();

      var fileInput = $('#profile_pic')[0];

      if(fileInput.files.length > 0){
        var filePath = fileInput.value;
      var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
      var maxSize = 2 * 1024 * 1024; // 2 MB
      
      //file format
      if (!allowedExtensions.exec(filePath)) {
        Swal.fire({
            icon: "warning",
            title: "Invalid file type. Only jpg, jpeg, and png files are allowed.",
            });
            $('#profile_pic').val(''); // Clear the input
            e.preventDefault(); // Prevent the form from submitting
            return false;
    }

    // Validate file size
    if (fileInput.files.length > 0 && fileInput.files[0].size > maxSize) {
        Swal.fire({
            icon: "warning",
            title: "File size must be less than 2 MB.",
            });
        $('#profile_pic').val(''); // Clear the input
        e.preventDefault(); // Prevent the form from submitting
        return false;
      }
      }
     
        
  
var memberFormData = new FormData(this);
// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/member_information_store',memberFormData).then(response=>{
  console.log(response);
  window.location.reload();
  Swal.fire({
              icon: "success",
              title: ''+ response.data.message,
            });
        return false;
        
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message.email,
              }))
 });

});
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
    });
//initialize summernote
$('.summernote').summernote();


</script>
@endpush

