@extends('master')

@section('title')
Rent
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('rent_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
            
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Rent Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateRentForm" >
                            <div class="row">  
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Rent Pay Date <small style="color: red">*</small></label>
                                        <input type="date" required  id="rent_pay_date" value="{{$rent->rent_pay_date}}" name="rent_pay_date" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                                <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Rent Amount <small style="color: red">*</small></label>
                                    <input type="number" required  id="rent_amount" value="{{$rent->rent_amount}}" step="0.01" name="rent_amount" class="form-control form-control-lg" />
                                </div>                                   
                              </div>

                            <input type="hidden" value="{{$rent->id}}" name="id" id="rent_id">
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


    document.getElementById('updateRentForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateRentFormData = new FormData(this);
    var rent_id = document.getElementById('rent_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_rent/' + rent_id, updateRentFormData).then(response=>{
    console.log(response);
    setTimeout(function() {
        window.location.href = "{{ route('rent_list') }}";
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