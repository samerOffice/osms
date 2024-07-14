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
                <a class="btn btn-outline-info float-right" href="{{route('item_category_list')}}">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div>

               
            <div class="col-12">
                <br>
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Update Item Category Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateItemCategoryForm" >
                            <div class="row">       
                                <div class="col-md-12 col-sm-12">
                                    <div  class="form-group mb-4">
                                        <label>Item Category Name <small style="color: red">*</small></label>
                                        <input type="text" required placeholder="Ex. Electronics" id="item_category_name" value="{{$item_category->name}}" name="item_category_name" class="form-control form-control-lg" />
                                    </div> 
                                </div>
                    
                               
                                <div class="col-md-12 col-sm-12">
                                  <div class="form-group mb-4">
                                      <label>Status <small style="color: red">*</small></label>
                                      <select class="form-control select2bs4" required id="active_status" name="active_status" style="width: 100%;">
                                          <option selected value="{{$item_category->active_status}}">
                                              @if(($item_category->active_status) == 1)
                                              Active
                                              @else
                                              Inactive
                                              @endif
                                          </option>
                                          <option value="1">Active</option>
                                          <option value="2">Inative</option>
                                      </select>
                                    </div>
                                  </div>

                              </div>

                            <input type="hidden" value="{{$item_category->id}}" name="id" id="item_category_id">
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

    document.getElementById('updateItemCategoryForm').addEventListener('submit',function(event){
    event.preventDefault();

    var updateItemCategoryFormData = new FormData(this);
    var item_category_id = document.getElementById('item_category_id').value;
    
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/osms/api/update_item_category/' + item_category_id, updateItemCategoryFormData).then(response=>{
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