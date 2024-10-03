@extends('master')

@section('title')
Edit Asset Details
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
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
                    <h3 class="card-title">Update Asset Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateAssetForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Asset Name <small style="color: red">*</small></label>
                                        <input type="text" required  id="asset_name"  value="{{$asset->asset_name}}" name="asset_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Asset Type <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="Example : Furniture" id="asset_type" value="{{$asset->asset_type}}" name="asset_type" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                                
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Purchase Date </label>
                                        <input type="date"  id="purchase_date" value="{{$asset->purchase_date}}" name="purchase_date" class="form-control form-control-lg" />
                                    </div> 
                                </div>
    
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Cost (BDT) </label>
                                        <input type="number" step="0.01" id="cost" name="cost" value="{{$asset->cost}}" class="form-control form-control-lg" />
                                    </div> 
                                </div>


                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Branch</label>
                                        <select class="form-control select2bs4" id="branch_id" name="branch_id" style="width: 100%;">                                  
                                          <option value="{{$asset->branch_id}}">{{$asset->branch_name}}</option>
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
                                        <option value="{{$asset->department_id}}">{{$asset->department_name}}</option>
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
                                        <option value="{{$asset->warehouse_id}}">{{$asset->warehouse_name}}</option>
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
                                        <option value="{{$asset->outlet_id}}">{{$asset->outlet_name}}</option>
                                        @foreach ($outlets as $outlet)
                                          <option value="{{$outlet->id}}">{{$outlet->outlet_name}}</option> 
                                          @endforeach                           
                                      </select>
                                      </div> 
                                </div>

                                 {{-- <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Depreciation Rate (%)</label>
                                    <input type="number" step="0.01" id="depreciation_rate" name="depreciation_rate" value="{{$asset->depreciation_rate}}" class="form-control form-control-lg" />
                                </div> 
                            </div> --}}

                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Note </label>
                                        <input type="text"  id="notes" value="{{$asset->notes}}" name="notes" class="form-control form-control-lg" />
                                    </div> 
                                </div>
    
                                <div class="col-md-12 col-sm-12">
                                <div class="form-group mb-4">
                                    <label>Outlet Status <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" required id="status" name="status" style="width: 100%;">
                                        <option selected value="{{$asset->status}}">
                                            @if(($asset->status) == 1)
                                            Active
                                            @elseif(($asset->status) == 2)
                                            Inactive
                                            @elseif(($asset->status) == 3)
                                            Maintainance
                                            @else
                                            Damaged
                                            @endif
                                        </option>
                                        <option value="1">Active</option>                    
                                        <option value="2">Inactive</option>                          
                                        <option value="3">Maintainance</option>                          
                                        <option value="4">Damaged</option>  
                                    </select>
                                  </div>
                                </div>                                     
                              </div>

                            <input type="hidden" value="{{$asset->id}}" name="id" id="asset_id">
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



    document.getElementById('updateAssetForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateAssetFormData = new FormData(this);
    var asset_id = document.getElementById('asset_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_asset/' + asset_id, updateAssetFormData).then(response=>{
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