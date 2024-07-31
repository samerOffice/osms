@extends('master')

@section('title')
Welcome
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('business_type_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Business Type Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateBusinessTypeForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Level <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="business_status" name="business_status" style="width: 100%;">
                                            <option selected value="{{$business_type->business_status}}">
                                                @if($business_type->business_status == 1)
                                                Active
                                                @else
                                                Inactive
                                                @endif
                                            </option>
                                            <option value="">Select</option> 
                                            <option value="1">Active</option>     
                                            <option value="2">Inactive</option> 
                                        </select>
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Business Type <small style="color: red">*</small></label>
                                    <input type="text" class="form-control" required id="business_type" name="business_type" value="{{$business_type->business_type}}">
                                </div> 
                                </div>                                     
                              </div>

                            <input type="hidden" value="{{$business_type->id}}" name="id" id="business_type_id">
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
});


    document.getElementById('updateBusinessTypeForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateBusinessTypeFormData = new FormData(this);
    var business_type_id = document.getElementById('business_type_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/osms/api/update_business_type/' + business_type_id, updateBusinessTypeFormData).then(response=>{
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