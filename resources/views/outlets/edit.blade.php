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
                <a class="btn btn-outline-info float-right" href="{{route('outlet_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Outlet Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateOutletForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Outlet Name <small style="color: red">*</small></label>
                                        <input type="text" required  id="outlet_name"  value="{{$outlet->outlet_name}}" name="outlet_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Outlet Address <small style="color: red">*</small></label>
                                    <textarea name="outlet_address" required id="outlet_address"  class="form-control form-control-lg summernote">{{$outlet->outlet_address}}</textarea>
                                </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label >Branch <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="branch_id" name="branch_id" style="width: 100%;">
                                        <option selected value="{{$outlet->branch_id}}">{{$outlet->branch_name}}</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                </div>
    
                                <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Outlet Status <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="outlet_status" name="outlet_status" style="width: 100%;">
                                        <option selected value="{{$outlet->outlet_status}}">
                                            @if(($outlet->outlet_status) == 1)
                                            Open
                                            @else
                                            Closed
                                            @endif
                                        </option>
                                        <option  value="1">Open</option>
                                        <option  value="2">Closed</option>
                                    </select>
                                  </div>
                                </div>                                     
                              </div>

                            <input type="hidden" value="{{$outlet->id}}" name="id" id="outlet_id">
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



    document.getElementById('updateOutletForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateOutletFormData = new FormData(this);
    var outlet_id = document.getElementById('outlet_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/osms/api/update_outlet/' + outlet_id, updateOutletFormData).then(response=>{
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