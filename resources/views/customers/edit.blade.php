@extends('master')

@section('title')
Customer
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('customer_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Customer Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateCustomerForm" >
                            <div class="row">  
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Customer Name <small style="color: red">*</small></label>
                                        <input type="text" required  id="customer_name" value="{{$customer->customer_name}}" name="customer_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                    <label>Mobile Number <small style="color: red">*</small></label>
                                    <input type="text" required placeholder="016xxxxxxxx" id="customer_phone_number" value="{{$customer->customer_phone_number}}" name="customer_phone_number" class="form-control form-control-lg" />
                                    </div> 
                                </div>
    
    
                                <div class="col-md-12 col-sm-12">
                                    <div data-mdb-input-init class="form-outline mb-4">
                                    <label>Email</label>
                                    <input type="email"  id="customer_email" value="{{$customer->customer_email}}" name="customer_email" class="form-control form-control-lg" />
                                    </div> 
                                </div>


                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Active Status <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="active_status" name="active_status" style="width: 100%;">
                                            <option selected value="{{$customer->active_status}}">
                                                @if(($customer->active_status) == 1)
                                                Active
                                                @else
                                                Inactive
                                                @endif
                                            </option>
                                            <option  value="1">Active</option>
                                            <option  value="2">Inactive</option>
                                        </select>
                                    </div> 
                                </div>
                               
                              </div>

                            <input type="hidden" value="{{$customer->id}}" name="id" id="customer_id">
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


    document.getElementById('updateCustomerForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateCustomerFormData = new FormData(this);
    var customer_id = document.getElementById('customer_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_customer/' + customer_id, updateCustomerFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
            // window.location.reload();
            window.location.href = "{{ route('customer_list') }}";
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