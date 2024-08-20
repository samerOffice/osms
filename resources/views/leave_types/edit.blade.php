@extends('master')

@section('title')
Edit Item Category
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('leave_types')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

               
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Leave Type</h3>
                  </div>  
                    <div class="card-body">
                        <form id="leaveTypeForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Type Name <small style="color: red">*</small></label>
                                        <input type="text" required id="type_name" value="{{$leave_type->type_name}}" name="type_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                              </div>

                            <input type="hidden" value="{{$leave_type->id}}" name="id" id="leave_type_id">
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

    document.getElementById('leaveTypeForm').addEventListener('submit',function(event){
    event.preventDefault();

    var leaveTypeFormData = new FormData(this);
    var leave_type_id = document.getElementById('leave_type_id').value;
    
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_leave_type/' + leave_type_id, leaveTypeFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
        window.location.href = "{{ route('leave_types') }}";
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