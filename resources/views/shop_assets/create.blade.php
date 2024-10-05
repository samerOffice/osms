@extends('master')

@section('title')
Assets
@endsection

@section('content')
@if (Auth::check())
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('asset_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>         
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Asset</h3>
                      </div>
                    <div class="card-body">
                        <form id="addAssetForm">
                        <div class="row"> 
                            
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Asset Name <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Asset Name" id="asset_name" name="asset_name" class="form-control form-control-lg" />
                                </div> 
                            </div> 

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Asset Type <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="Example : Furniture" id="asset_type" name="asset_type" class="form-control form-control-lg" />
                                </div> 
                            </div>
                            
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Purchase Date </label>
                                    <input type="date"  id="purchase_date" name="purchase_date" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Cost (BDT) </label>
                                    <input type="number" step="0.01" id="cost" name="cost" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Branch</label>
                                    <select class="form-control select2bs4" id="branch_id" name="branch_id" style="width: 100%;">
                                    <option value="">Select</option>                              
                                      @foreach ($branches as $branch)
                                      <option value="{{$branch->id}}">{{$branch->br_name}}</option> 
                                      @endforeach                           
                                  </select>
                                  </div> 
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Department</label>
                                    <select  class="form-control select2bs4" id="department_id" name="department_id" style="width: 100%;"> 
                                    <option value="">Select</option>                                 
                                      @foreach ($departments as $department)
                                      <option value="{{$department->id}}">{{$department->dept_name}}</option> 
                                      @endforeach                           
                                  </select>
                                  </div> 
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Warehouse</label>
                                    <select  class="form-control select2bs4" id="warehouse_id" name="warehouse_id" style="width: 100%;">                                  
                                    <option value="">Select</option> 
                                     @foreach ($warehouses as $warehouse)
                                      <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option> 
                                      @endforeach                           
                                  </select>
                                  </div> 
                            </div>

                            <div class="col-md-6 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Outlet</label>
                                    <select  class="form-control select2bs4" id="outlet_id" name="outlet_id" style="width: 100%;">                                  
                                    <option value="">Select</option> 
                                    @foreach ($outlets as $outlet)
                                      <option value="{{$outlet->id}}">{{$outlet->outlet_name}}</option> 
                                      @endforeach                           
                                  </select>
                                  </div> 
                            </div>

                            {{-- <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Depreciation Rate (%)</label>
                                    <input type="number" step="0.01" id="depreciation_rate" name="depreciation_rate" class="form-control form-control-lg" />
                                </div> 
                            </div> --}}

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Note </label>
                                    <input type="text"  id="notes" name="notes" class="form-control form-control-lg" />
                                </div> 
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Status <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="status" name="status" style="width: 100%;">                                  
                                      <option value="">Select</option>        
                                      <option value="1">Active</option>                    
                                      <option value="2">Inactive</option>                          
                                      <option value="3">Maintainance</option>                          
                                      <option value="4">Damaged</option>                          
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


document.getElementById('addAssetForm').addEventListener('submit',function(event){
  event.preventDefault();

    var addAssetFormData = new FormData(this);

    var asset_name = document.getElementById('asset_name').value;
    if(asset_name == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Asset Name",
            });
        return false;
    }

    var asset_type = document.getElementById('asset_type').value;
    if(asset_type == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Asset Type",
            });
        return false;
    }


    var status = document.getElementById('status').value;
    if(status == ''){
    Swal.fire({
            icon: "warning",
            title: "Please Enter Status",
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
axios.post('/api/asset_store',addAssetFormData).then(response=>{
  console.log(response);
//   window.location.reload();
window.location.href = "{{ route('asset_list') }}";
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

