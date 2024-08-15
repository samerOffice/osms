@extends('master')


@section('title')
Terms & Conditions
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
         
          <div class="col-12">
            <br>
            @if ($message = Session::get('success'))
            <div class="alert alert-info" role="alert">
              <div class="row">
                <div class="col-11">
                  {{ $message }}
                </div>
                <div class="col-1">
                  <button type="button" class=" btn btn-info" data-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
              </div>
            </div>
            @endif
        </div>
            <div class="col-12">
              <br>  
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Terms and Conditions</h3>
                  </div>  
                    <div class="card-body">

                      @if(!empty($terms_and_conditions->id))
                        <form id="updateTermAndConditionForm">
                            <div class="card-body">   
                                  <div class="form-group">
                                    <label>Terms and Conditions</label>
                                    <textarea name="descriptions" class="form-control">
                                      {{ $terms_and_conditions->descriptions }}
                                    </textarea>
                                  </div>                                 
                              </div>
                            <!-- /.card-body -->
                            <input type="hidden" value="{{ $terms_and_conditions->id }}" name="id" id="terms_and_conditions_id">
                            <button type="submit" id="sub" class="btn btn-info float-right mr-4">Update</button>
                          </form>
                        @else
                        <div class="col-12">
                          <a class="btn btn-outline-info float-right" href="{{route('add_terms_and_conditions')}}">
                              <i class="fas fa-plus"></i> Add T&C
                          </a>          
                       </div>
                       @endif
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
<script>
 
    document.getElementById('updateTermAndConditionForm').addEventListener('submit',function(event){
    event.preventDefault();

    var updateTermAndConditionFormData = new FormData(this);
    var terms_and_conditions_id = document.getElementById('terms_and_conditions_id').value;
    
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/api/update_terms_and_conditions/' + terms_and_conditions_id, updateTermAndConditionFormData).then(response=>{
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
