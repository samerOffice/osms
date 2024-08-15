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
                <a class="btn btn-outline-info float-right" href="{{route('terms_and_conditions')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>
          
            <div class="col-12">
              <br>  
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Terms and Conditions</h3>
                  </div>  
                    <div class="card-body">
                        <form id="termAndConditionAddForm">  
                            @csrf
                            <div class="card-body">   
                                  <div class="form-group">
                                    <label>Terms and Conditions</label>
                                    <textarea class="form-control" name="descriptions" required></textarea>
                                  </div>                                 
                              </div>
                            <!-- /.card-body -->
                            <input type="hidden" value="" name="id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Submit</button>
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

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection



@push('masterScripts')
<script type="text/javascript">

document.getElementById('termAndConditionAddForm').addEventListener('submit',function(event){
  event.preventDefault();

var termAndConditionAddFormData = new FormData(this);

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/store_terms_and_conditions',termAndConditionAddFormData).then(response=>{
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
