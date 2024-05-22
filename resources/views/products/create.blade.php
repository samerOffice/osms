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
            {{-- <div class="col-12">
                <a class="btn btn-outline-info float-right" href="">
                    <i class="fas fa-arrow-left"></i> Back
                </a>
            </div> --}}

               
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Product</h3>
                      </div>
                    <div class="card-body">
                        <form id="productForm" >                                        
                            <div class="card-body">

                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Item Category</label>
                                        <select required class="form-control select2bs4" id="item_category_id" name="item_category_id" style="width: 100%;">                                  
                                          <option value="">Select Item Category</option>
                                          @foreach ($item_categories as $item)
                                          <option value="{{$item->id}}">{{$item->name}}</option>
                                          @endforeach                                                             
                                      </select>
                                      </div> 
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label >Product Category</label>
                                        <select required class="form-control select2bs4" id="product_category_id" name="product_category_id" style="width: 100%;">                                  
                                          <option value="">Select Product Category</option>                                        
                                          <option value=""></option>                                                                                              
                                      </select>
                                      </div> 
                                </div>
                            </div>                    

                          
                                <div class="form-group">
                                    <label >Product Type</label>
                                    <select required class="form-control select2bs4" id="product_type" name="product_type" style="width: 100%;">                                  
                                      <option value="">Select Product Type</option>                                        
                                      <option value="1">Batch</option>                                                                                              
                                      <option value="2">Single Item</option>                                                                                              
                                  </select>
                                  </div> 
                           

                              <div class="form-group">
                                <label >Product Name</label>
                                <input type="text" required class="form-control" id="product_name" name="product_name" >
                              </div>

                              <div class="form-group">
                                <label >Per Product Price</label>
                                <input type="text"  class="form-control" id="product_single_price" name="product_single_price" >
                              </div>

                              <div class="form-group">
                                <label >Product Labeling Type</label>
                                <select required class="form-control select2bs4" id="labeling_type" name="labeling_type" style="width: 100%;">                                  
                                    <option value="">Select Product Labeling Type</option>                                        
                                    <option value="1">SKU</option>                                                                                              
                                    <option value="2">Barcode</option>                                                                                              
                                </select>
                              </div>

                              <div class="form-group">
                                <label >Batch Number</label>
                                <input type="text"  class="form-control" id="batch_number" name="batch_number" >
                              </div>

                              <div class="form-group">
                                <label >Tag Number</label>
                                <input type="text"  class="form-control" id="product_tag_number" name="product_tag_number" >
                              </div>

                              <div class="form-group">
                                <label >Product Weight</label>
                                <input type="text"  class="form-control" id="product_weight" name="product_weight" >
                              </div>

                              <div class="form-group">
                                <label>Quantity</label>
                                <input type="text"  class="form-control" id="quantity" name="quantity" >
                              </div>

                              <div class="form-group">
                                <label>Additional Product Details</label>
                                <textarea class="summernote" name="additional_product_details" id="additional_product_details"></textarea>
                              </div>

                              <div class="row">
                                <div class="col-md-4 col-sm-12">
                                <label>Product Entry Date</label>
                                <input type="date"  class="form-control" id="product_entry_date" name="product_entry_date" >
                                </div>
                                <div class="col-md-4 col-sm-12">
                                <label>Product MFG Date</label>
                                <input type="date"  class="form-control" id="product_mfg_date" name="product_mfg_date" >
                                </div>
                                <div class="col-md-4 col-sm-12">
                                <label>Product Expiry Date</label>
                                <input type="date"  class="form-control" id="product_expiry_date" name="product_expiry_date" >
                                </div>
                              </div>

                              <div class="form-group">
                                <br>
                                <label>Total Product In a Batch</label>
                                <input type="text"  class="form-control" id="total_product_in_a_batch" name="total_product_in_a_batch" >
                              </div>
                              
                              <div class="form-group">
                                <label>Product Batch Price</label>
                                <input type="text"  class="form-control" id="product_batch_price" name="product_batch_price" >
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

//item category and product category dependancy dropdown logic start
$('#item_category_id').on('change',function(event){
  event.preventDefault();
  var selectedItemCategory = $('#item_category_id').val();

  if (selectedItemCategory == '') {
        $('#product_category_id').html('');
        return false;
      }
  axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/item_category_and_product_category_dependancy',{
        data: selectedItemCategory
      }).then(response=>{
      $('#product_category_id').html(response.data);
        console.log(response.data);
      });
 });
});
//item category and product category dependancy dropdown logic end

document.getElementById('productForm').addEventListener('submit',function(event){
  event.preventDefault();

var productFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/submit_product',productFormData).then(response=>{
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

