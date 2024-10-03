@extends('master')

@section('title')
Product
@endsection


@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        
        <div class="row">

            <div class="col-12">
              <a class="btn btn-outline-info float-right" href="{{route('product_list')}}">
                  <i class="fas fa-arrow-left"></i> Back
              </a>
          </div> 
               
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
                                        <label >Item Category <small style="color: red">*</small></label>
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
                                        <label >Product Category <small style="color: red">*</small></label>
                                        <select required class="form-control select2bs4" id="product_category_id" name="product_category_id" style="width: 100%;">                                  
                                          <option value="">Select Product Category</option>                                        
                                          <option value=""></option>                                                                                              
                                      </select>
                                      </div> 
                                </div>

                            </div>                         
                                {{-- <div class="form-group">
                                    <label >Product Type</label>
                                    <select  class="form-control select2bs4" id="product_type" name="product_type" style="width: 100%;">                                  
                                      <option value="">Select Product Type</option>                                        
                                      <option value="1">Batch</option>                                                                                              
                                      <option value="2">Single Item</option>                                                                                              
                                  </select>
                                </div>  --}}

                              <div class="row">
                                <div class="col-12">
                                  <div class="form-group">
                                    <label >Product Name <small style="color: red">*</small></label>
                                    <input type="text" required class="form-control" id="product_name" name="product_name">
                                    {{-- <input type="text" required class="form-control" id="product_name" name="product_name" oninput="generateBarcode()"> --}}
                                  </div>
                                </div>
                                {{-- <div class="col-6">
                                  <div class="form-group">
                                    <label >Product Labeling Type <small style="color: red">*</small></label>
                                    <select class="form-control select2bs4" id="labeling_type" name="labeling_type" style="width: 100%;">                                  
                                        <option value="">Select</option>                                        
                                        <option value="1">SKU</option>                                                                                              
                                        <option value="2">Barcode</option>                                                                                              
                                    </select>
                                  </div>
                                </div> --}}
                                {{-- <div class="col-4"></div>
                                <div class="col-4"></div>
                                <div class="col-4">
                                  <svg id="barcode"></svg>
                                </div> --}}
                              </div>                                                         
                                {{-- <div class="form-group">
                                  <label >Tag Number</label>
                                  <input type="text" readonly  class="form-control" id="product_tag_number" name="product_tag_number" >
                                </div>--}}
                              
                              <div class="form-group">
                                <label>Product Details</label>
                                <textarea class="form-control" name="additional_product_details" id="additional_product_details"></textarea>
                              </div>

                              <div class="row">
                                <div class="col-6">
                                  <div class="form-group">
                                    <label >Product Weight <small style="color: red">*</small></label>
                                    <input type="text" required class="form-control" id="product_weight" name="product_weight" >
                                  </div>
                                </div>
                                <div class="col-6">
                                  <div class="form-group">
                                    <label for="product_unit_type">Unit <small style="color: red">*</small></label>
                                    <select required name="product_unit_type" class="form-control select2bs4">
                                        <option>--Select--</option>
                                        <option value="Dozen">Dozen</option>
                                        <option value="Box">Box</option>
                                        <option value="Gram">Gram</option>
                                        <option value="Kg">Kg</option>
                                        <option value="Liter">Liter</option>
                                        <option value="ML">ML</option>
                                        <option value="Meter">Meter</option>
                                        <option value="Unit">Unit</option>
                                        <option value="Pair">Pair</option>
                                        <option value="Piece">Piece</option>
                                        <option value="Others">Others</option>
                                    </select>  
                                    </div>
                                </div>
                                {{-- <div class="col-2">
                                  <div class="form-group">
                                    <label>Quantity <small style="color: red">*</small></label>
                                    <input type="number"  class="form-control" id="quantity" name="quantity" >
                                  </div>
                                </div>
                                <div class="col-3">
                                  <div class="form-group">
                                    <label>Unit Price <small style="color: red">*</small></label>
                                    <input type="number"  class="form-control" id="product_unit_price" name="product_unit_price" >
                                  </div>
                                </div>

                                <div class="col-3">
                                  <div class="form-group">
                                    <label style="color: green">Total Price</label>
                                    <input type="number" readonly  class="form-control" id="product_total_price" name="product_total_price" >
                                  </div>
                                </div> --}}
                              </div>                      

                              {{-- <div class="form-group">
                                <label >Batch Number</label>
                                <input type="text"  class="form-control" id="batch_number" name="batch_number" >
                              </div> --}}
                         

                              {{-- <div class="row">
                                <div class="col-md-4 col-sm-12">
                                <label>Product Entry Date</label>
                                <input type="date" readonly  class="form-control" id="product_entry_date" name="product_entry_date" value="{{ date('Y-m-d') }}">
                                </div>
                                <div class="col-md-4 col-sm-12">
                                <label>Product MFG Date</label>
                                <input type="date"  class="form-control" id="product_mfg_date" name="product_mfg_date" >
                                </div>
                                <div class="col-md-4 col-sm-12">
                                <label>Product Expiry Date</label>
                                <input type="date"  class="form-control" id="product_expiry_date" name="product_expiry_date" >
                                </div>
                              </div> --}}

                              {{-- <div class="form-group">
                                <br>
                                <label>Total Product In a Batch</label>
                                <input type="text"  class="form-control" id="total_product_in_a_batch" name="total_product_in_a_batch" >
                              </div> --}}
                              
                              {{-- <div class="form-group">
                                <label>Product Batch Price</label>
                                <input type="text"  class="form-control" id="product_batch_price" name="product_batch_price" >
                              </div> --}}
                             
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

<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

//initialize summernote
$('.summernote').summernote();

});


$('#product_unit_price').on('keyup', function() {
                var product_quantity = $("#quantity").val();
                var product_unit_price = $("#product_unit_price").val();
                var total = (parseFloat(product_quantity) * parseFloat(product_unit_price));
                $("#product_total_price").val(total ? total.toFixed(2) : 0.00);
            });



$('#labeling_type').on('change',function(){

  var labeling_type = $('#labeling_type').val();

  if(labeling_type == 2){
    generateProductBarCodeID();
  }else{
    const selectedItemCategoryName = $("#item_category_id option:selected").text();
    const selectedProductCategoryName = $("#product_category_id option:selected").text();
    const productName = $("#product_name").val();

    if ((selectedItemCategoryName !== "Select Item Category") && (selectedProductCategoryName !== "Select Product Category")) {                 
        generateProductSKUID(selectedItemCategoryName, selectedProductCategoryName, productName);
    }
    
  }
  
})

function generateProductBarCodeID() {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const milliseconds = String(now.getMilliseconds()).padStart(3, '0');
        // Example format: INV-YYYYMMDD-HHMMSS-SSS
        const orderID = `Pro-${year}${month}${day}-${hours}${minutes}${seconds}-${milliseconds}`;    
        $("#product_tag_number").val(orderID);
        // generateBarcode(orderID);
    }

    function generateProductSKUID(selectedItemCategoryName, selectedProductCategoryName, productName) {
        const now = new Date();
        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const milliseconds = String(now.getMilliseconds()).padStart(3, '0');
        // Example format: INV-YYYYMMDD-HHMMSS-SSS
        const orderID = `SKU-${selectedItemCategoryName}-${selectedProductCategoryName}-${productName}-${year}${month}${day}-${hours}${minutes}${seconds}-${milliseconds}`;
          $("#product_tag_number").val(orderID);    
    }


// function generateBarcode(orderID){
//             var input = orderID;
//             JsBarcode("#barcode", input, {
//                 format: "CODE128",
//                 lineColor: "black",
//                 width: 2,
//                 height: 40,
//                 displayValue: false
//             });
//         }

//item category and product category dependancy dropdown logic start
$('#item_category_id').on('change',function(event){
  event.preventDefault();
  var selectedItemCategory = $('#item_category_id').val();

  if (selectedItemCategory == '') {
        $('#product_category_id').html('');
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
 axios.post('/api/item_category_and_product_category_dependancy',{
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

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/submit_product',productFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
        //  window.location.reload();
        window.location.href = "{{ route('product_list') }}";
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

</script>
@endpush

