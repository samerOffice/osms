@extends('master')

@section('title')
Utility
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('utility_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Utility Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateUtilityForm" >
                            <div class="row">  
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Utility Pay Date <small style="color: red">*</small></label>
                                        <input type="date" required  id="utility_pay_date" value="{{$utility->utility_pay_date}}" name="utility_pay_date" class="form-control form-control-lg" />
                                    </div> 
                                </div>

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Utility Type <small style="color: red">*</small></label>
                                        <input type="text" required  id="utility_type" value="{{$utility->utility_type}}" name="utility_type" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Utility Amount <small style="color: red">*</small></label>
                                    <input type="number" required  id="utility_amount" value="{{$utility->utility_amount}}" step="0.01" name="utility_amount" class="form-control form-control-lg" />
                                </div>                                   
                              </div>

                            <input type="hidden" value="{{$utility->id}}" name="id" id="utility_id">
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


    document.getElementById('updateUtilityForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateUtilityFormData = new FormData(this);
    var utility_id = document.getElementById('utility_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_utility/' + utility_id, updateUtilityFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
        window.location.href = "{{ route('utility_list') }}";
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