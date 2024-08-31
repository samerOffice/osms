@extends('master')

@section('title')
Edit Warehouse
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
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
                    <h3 class="card-title">Update Warehouse Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updatewarehouseForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Warehouse Name <small style="color: red">*</small></label>
                                        <input type="text" required  id="warehouse_name"  value="{{$warehouse->warehouse_name}}" name="warehouse_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Warehouse Address <small style="color: red">*</small></label>
                                    <textarea name="warehouse_address" required id="warehouse_address"  class="form-control form-control-lg summernote">{{$warehouse->warehouse_address}}</textarea>
                                </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label >Branch <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="branch_id" name="branch_id" style="width: 100%;">
                                        <option selected value="{{$warehouse->branch_id}}">{{$warehouse->branch_name}}</option>
                                        @foreach($branches as $branch)
                                        <option value="{{$branch->id}}">{{$branch->br_name}}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                </div>
    
                                <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Warehouse Status <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="warehouse_status" name="warehouse_status" style="width: 100%;">
                                        <option selected value="{{$warehouse->warehouse_status}}">
                                            @if(($warehouse->warehouse_status) == 1)
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

                            <input type="hidden" value="{{$warehouse->id}}" name="id" id="warehouse_id">
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



    document.getElementById('updatewarehouseForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updatewarehouseFormData = new FormData(this);
    var warehouse_id = document.getElementById('warehouse_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_warehouse/' + warehouse_id, updatewarehouseFormData).then(response=>{
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