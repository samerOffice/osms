@extends('master')

@section('title')
Welcome
@endsection

@push('css')
<style>
    .switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
@endpush


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
            {{-- <div class="col-12">
                <a class="btn btn-outline-info float-right" href="">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div> --}}

               
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Product Category</h3>
                      </div>
                    <div class="card-body">
                        <form id="productCategoryForm" >                                        
                            <div class="card-body">

                              <div class="form-group">
                                <label >Item Category</label>
                                <select required class="form-control select2bs4" id="item_category_id" name="item_category_id" style="width: 100%;">                                  
                                  <option value="">Select Item Category</option>
                                  @foreach ($item_categories as $item)
                                  <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                                                             
                              </select>
                              </div> 
                              <div class="form-group">
                                <label >Product Category Name</label>
                                <input type="text" required class="form-control" id="product_category_name" name="product_category_name" >
                              </div> 
                              
                              <div class="form-group">
                                <label> Status </label>
                                <label class="switch">
                                    <input type="checkbox" id="toggleButton" name="active_status" value="" class="toggle-switch-checkbox">
                                    <span class="slider round"></span>
                                  </label>
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <button type="submit" class="btn btn-info float-right mr-4">Submit</button>
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


// Event listener to toggle the input value when the switch is clicked
$('.toggle-switch-checkbox').change(function() {
           
           if ($(this).is(':checked')) {
               // Checkbox is checked and '1' is for activate
               $('#toggleButton').val(1);
           } else {
               // Checkbox is unchecked and '2' is for deactivate
               $('#toggleButton').val(2);
           }
       });   

document.getElementById('productCategoryForm').addEventListener('submit',function(event){
  event.preventDefault();

var productCategoryFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/submit_product_category',productCategoryFormData).then(response=>{
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
              title: error.response.data.message.email,
              }))
 });

});
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
    });
//initialize summernote
$('.summernote').summernote();


</script>
@endpush

