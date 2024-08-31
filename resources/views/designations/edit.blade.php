@extends('master')

@section('title')
Edit Designation
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('designation_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Designation Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateDesignationForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Level <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="level" name="level" style="width: 100%;">
                                            <option selected value="{{$designation->level}}">
                                                @if($designation->level == 1)
                                                Managing Level
                                                @elseif($designation->level == 2)
                                                Operational Level
                                                @else
                                                Support Level
                                                @endif
                                            </option>
                                            <option value="">Select Level</option>                                      
                                            <option value="1">Managing Level</option>                                   
                                            <option value="2">Operational Level</option>                                   
                                            <option value="3">Support Level</option>    
                                        </select>
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Designation <small style="color: red">*</small></label>
                                    <input type="text" class="form-control" required id="designation_name" name="designation_name" value="{{$designation->designation_name}}">
                                </div> 
                                </div>                                     
                              </div>

                            <input type="hidden" value="{{$designation->id}}" name="id" id="designation_id">
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


    document.getElementById('updateDesignationForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateDesignationFormData = new FormData(this);
    var designation_id = document.getElementById('designation_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_designation/' + designation_id, updateDesignationFormData).then(response=>{
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