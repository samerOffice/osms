@extends('master')

@section('title')
Product Edit
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
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
                    <h3 class="card-title">Update Product Details</h3>
                  </div>  
                    <div class="card-body">
                        <form id="updateProductForm" >
                            <div class="row">  
                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Item Category <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="item_category_id" name="item_category_id" style="width: 100%;">
                                            <option selected value="{{$product->item_category_id}}">{{$product->item_category_name}}</option>
                                            @foreach($item_categories as $item_category)
                                            <option value="{{$item_category->id}}">{{$item_category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div> 
                                </div>

                                <div class="col-md-6 col-sm-6">
                                    <div  class="form-group mb-4">
                                        <label>Product Category <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="product_category_id" name="product_category_id" style="width: 100%;">
                                            <option selected value="{{$product->product_category_id}}">{{$product->product_category_name}}</option>
                                            <option value="">-select-</option>
                                        </select>
                                    </div> 
                                </div>
                    
                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Product Name<small style="color: red">*</small></label>
                                    <input type="text" required  id="product_name" value="{{$product->product_name}}" name="product_name" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label >Product Labeling Type <small style="color: red">*</small></label>
                                    <select required class="form-control select2bs4" id="labeling_type" name="labeling_type" style="width: 100%;">                                  
                                        <option value="{{$product->labeling_type}}">
                                            @if($product->labeling_type == 1)
                                            SKU
                                            @else
                                            Barcode
                                            @endif
                                        </option>                                        
                                        <option value="1">SKU</option>                                                                                              
                                        <option value="2">Barcode</option>                                                                                              
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <span><label for="">Old Tag Number :</label><br> {{$product->product_tag_number}}</span>
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>New Tag Number<small style="color: red">*</small></label>
                                    <input type="text" readonly required  id="product_tag_number" name="product_tag_number" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-12 col-sm-12">
                                <div  class="form-group mb-4">
                                    <label>Product Details </label>
                                    <textarea name="additional_product_details" id="additional_product_details"  class="form-control form-control-lg ">{{$product->additional_product_details}}</textarea>
                                </div> 
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div  class="form-group mb-4">
                                    <label>Product Weight</label>
                                    <input type="text" id="product_name" value="{{$product->product_weight}}" name="product_weight" class="form-control form-control-lg" />
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group mb-4">
                                <label>Product Unit <small style="color: red">*</small></label>
                                <select required class="form-control select2bs4" id="product_unit_type" name="product_unit_type" style="width: 100%;">                                  
                                    <option value="{{$product->product_unit_type}}">{{$product->product_unit_type}}</option>                                        
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

                            <div class="col-md-4 col-sm-4">
                                <div  class="form-group mb-4">
                                    <label>Product Entry Date</label>
                                    <input type="date"  class="form-control" id="product_entry_date" name="product_entry_date" value="{{$product->product_entry_date}}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div  class="form-group mb-4">
                                    <label>Product MFG Date</label>
                                    <input type="date"  class="form-control" id="product_mfg_date" name="product_mfg_date" value="{{$product->product_mfg_date}}">
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-4">
                                <div  class="form-group mb-4">
                                    <label>Product Expiry Date</label>
                                    <input type="date"  class="form-control" id="product_expiry_date" name="product_expiry_date" value="{{$product->product_expiry_date}}">
                                </div>
                            </div>

                                <div class="col-md-12 col-sm-12">
                                    <div class="form-group mb-4">
                                        <label>Status <small style="color: red">*</small></label>
                                        <select class="form-control select2bs4" required id="product_status" name="product_status" style="width: 100%;">
                                            <option selected value="{{$product->product_status}}">
                                                @if(($product->product_status) == 1)
                                                Available
                                                @elseif(($product->product_status) == 2)
                                                Not Available
                                                @else
                                                Damaged
                                                @endif
                                            </option>
                                            <option value="1">Available</option>
                                            <option value="2">Not Available</option>
                                            <option value="3">Damaged</option>
                                        </select>
                                    </div> 
                                </div>
                    
                                        
                              </div>

                            <input type="hidden" value="{{$product->id}}" name="id" id="product_id">
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

// axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/item_category_and_product_category_dependancy',{
        data: selectedItemCategory
      }).then(response=>{
      $('#product_category_id').html(response.data);
        console.log(response.data);
      });
//  });
});
//item category and product category dependancy dropdown logic end


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


    document.getElementById('updateProductForm').addEventListener('submit',function(event){
    event.preventDefault();


    var updateProductFormData = new FormData(this);
    var product_id = document.getElementById('product_id').value;

   
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/osms/api/update_product/' + product_id, updateProductFormData).then(response=>{
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