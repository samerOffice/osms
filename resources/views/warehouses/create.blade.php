@extends('master')

@section('title')
Welcome
@endsection

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('warehouse_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Warehouse</h3>
                      </div>
                    <div class="card-body">
                        <form id="addwarehouseForm">
                        <div class="row">       
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Warehouse Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Warehouse Name" id="warehouse_name" name="warehouse_name" class="form-control form-control-lg" />
                                </div> 
                            </div>
                
                            <div class="col-md-12 col-sm-12">
                            <div  class="form-group mb-4">
                                <label>Warehouse Address <small style="color: red">*</small></label>
                                <textarea name="warehouse_address" required id="warehouse_address"  class="form-control form-control-lg summernote"></textarea>
                            </div> 
                            </div>


                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Branch <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="branch_id" name="branch_id" style="width: 100%;">                                  
                                      <option value="">Select Branch</option>
                                      @foreach ($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                      @endforeach                                                             
                                  </select>
                                  </div> 
                            </div>                          

                            <div class="col-md-12 col-sm-12">
                              <div class="form-group mb-4">
                                  <label>Warehouse Status <small style="color: red">*</small></label>
                                  <select required class="form-control select2bs4" id="warehouse_status" name="warehouse_status" style="width: 100%;">                                  
                                    <option value="1">Open</option>
                                    <option value="2">Closed</option>                                                          
                                </select>
                                </div>
                              </div>
                                                    
                          </div>
                          <button type="submit" class="btn btn-success float-right">Submit</button>
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



$(document).ready(function() {

    //Initialize Select2 Elements
    $('.select2bs4').select2({
          theme: 'bootstrap4'
        })

    //initialize summernote
    $('.summernote').summernote();

});


document.getElementById('addwarehouseForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addwarehouseFormData = new FormData(this);

    var warehouse_name = document.getElementById('warehouse_name').value;
    if(warehouse_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Warehouse Name",
            });
        return false;
    }

    var warehouse_address = document.getElementById('warehouse_address').value;
    if(warehouse_address == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Warehouse Address",
            });
        return false;
    }

    var branch_id = document.getElementById('branch_id').value;
    if(branch_id == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Branch",
            });
        return false;
    }

    var warehouse_status = document.getElementById('warehouse_status').value;
    if(warehouse_status == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Select Status",
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


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/warehouse_store',addwarehouseFormData).then(response=>{
  console.log(response);
  window.location.reload();
  Swal.fire({
              icon: "success",
              title: ''+ response.data.message,
            });
        return false;
        
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data.message,
              }))
 });

});

</script>
@endpush

