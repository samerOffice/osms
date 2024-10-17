@extends('master')

@section('title')
Edit Branch
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('branch_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

               
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Branch Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateBranchForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Branch Name <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="Branch Name" id="br_name"  value="{{$branch->br_name}}" name="br_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label for="br_address">Branch Address <small style="color: red">*</small></label>
                                    <textarea name="br_address" required id="br_address"  class="form-control form-control-lg summernote">{{$branch->br_address}}</textarea>
                                </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label >Branch Type <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="br_type" name="br_type" style="width: 100%;">
                                        <option selected value="{{$branch->br_type}}">
                                            @if(($branch->br_type)==1)
                                            Head Office
                                            @else
                                            Single Branch
                                            @endif
                                        </option>
                                        <option selected="selected" value="1">Head Office</option>
                                        <option value="2">Single Branch</option>
                                    </select>
                                </div>  
                                </div>                        

                              <div class="col-md-12 col-sm-12">
                                  <div class="form-group mb-4">
                                      <label>Branch Status <small style="color: red">*</small></label>
                                      <select class="form-control select2bs4" required id="br_status" name="br_status" style="width: 100%;">
                                          <option selected value="{{$branch->br_status}}">
                                              @if(($branch->br_status) == 1)
                                              Active
                                              @else
                                              Inactive
                                              @endif
                                          </option>
                                          <option value="1">Active</option>
                                          <option value="2">Inative</option>
                                      </select>
                                    </div>
                                </div>
                              </div>

                              <br>
                              <h4>Set Office Geolocation</h4>
                              <div class="row" id="locationDisplay">
                                  <div class="col-md-5 col-sm-12">
                                    <div class="form-group ">
                                      <label>Latitude <small style="color: red">*</small></label>
                                      <input readonly required type="text" id="currentLat" name="latitude" value="{{$branch->latitude}}" class="form-control">
                                    </div> 
                                  </div>

                                  <div class="col-md-5 col-sm-12">
                                    <div class="form-group ">
                                      <label>Longitude <small style="color: red">*</small></label>
                                      <input readonly required type="text" id="currentLon" name="longitude" value="{{$branch->longitude}}" class="form-control">
                                    </div> 
                                  </div>
                                  
                                  <div class="col-md-2 col-sm-12">
                                    <div class="form-group mb-4">
                                  <button type="button" id="getLocationBtn" class="btn btn-primary mt-4">Get Current Location</button>
                                    </div>                          
                                  </div>                          
                              </div>

                            <input type="hidden" value="{{$branch->id}}" name="id" id="branch_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
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

  </div>

@endsection

@push('masterScripts')
<script>
 
 $(document).ready(function() {

//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

//initialize summernote
$('.summernote').summernote();
     
  });


  document.getElementById('getLocationBtn').addEventListener('click', function() {

if (navigator.geolocation) {
  // alert('hi');
  navigator.geolocation.getCurrentPosition(function(position) {
    let latitude = position.coords.latitude;
    let longitude = position.coords.longitude;

    // Update the span content with latitude and longitude
    // document.getElementById('currentLat').textContent = "Latitude: " + latitude;
    // document.getElementById('currentLon').textContent = "Longitude: " + longitude;

    document.getElementById('currentLat').value = latitude;
    document.getElementById('currentLon').value = longitude;

}, function(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            alert("User denied the request for Geolocation.");
            break;
        case error.POSITION_UNAVAILABLE:
            alert("Location information is unavailable.");
            break;
        case error.TIMEOUT:
            alert("The request to get user location timed out.");
            break;
        case error.UNKNOWN_ERROR:
            alert("An unknown error occurred.");
            break;
    }
});
} else {
alert("Geolocation is not supported by this browser.");
}

});



    document.getElementById('updateBranchForm').addEventListener('submit',function(event){
    event.preventDefault();

    var updateBranchFormData = new FormData(this);
    var branch_id = document.getElementById('branch_id').value;
    
    var shop_branch_latitude = document.getElementById('currentLat').value;
    var shop_branch_longitude = document.getElementById('currentLon').value;

    if( (shop_branch_latitude == '') && (shop_branch_longitude == '') ){
    Swal.fire({
            icon: "warning",
            title: "Location is required.",
            });
        return false;
    }

    var branch_address = document.getElementById('br_address').value;
    
    if(branch_address == ''){
    Swal.fire({
            icon: "warning",
            title: "Branch Address is required.",
            });
        return false;
    }

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_branch/' + branch_id, updateBranchFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
            window.location.reload();
        }, 2000);
    Swal.fire({
                icon: "success",
                title: ''+ response.data.message,
                });
            return false;
            
    }).catch(error => Swal.fire({
                icon: "error",
                title: error.response.data.message,
                }))
    // });

    });
    
</script>
  @endpush