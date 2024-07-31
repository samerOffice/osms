@extends('master')

@section('title')
New Product Request Form
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">  
                    
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-outline-info float-right" href="{{route('requisition_list')}}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>                       
                    </div>
                    <br>

                    <div>

                    <div class="row">
                    <div class="col-12">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                    <div class="card-header">                                   
                        <h4 class="card-title ">Add New Request</h4>
                    </div>

                <div class="card-body" >
                {{-- form starts  --}}
                <form id="requisitionOrderForm" enctype="multipart/form-data">
                <div class="row" style=" margin: 0 10px; padding: 20px;"> 
                    <div class="col-12">
                        <div class="mb-3 row">
                            <div class="col-3">
                                <label  class="col-form-label text-start">Order ID</label>         
                                <input type="text" readonly id="requisition_order_id" name="requisition_order_id" class="form-control" />
                            </div> 
    
                            <div class="col-3">
                                <label  class="col-form-label text-start">Order Date</label>         
                                <input type="date" readonly id="requisition_order_date" name="requisition_order_date" value="{{ date('Y-m-d') }}" class="form-control" />
                            </div> 

                            <div class="col-3">
                                <label  class="col-form-label text-start">Order By</label>         
                                <input type="text" readonly id="requisition_order_by_name" name="requisition_order_by_name" value="{{$user_name}}" class="form-control" />
                                <input type="hidden" id="requisition_order_by" name="requisition_order_by" value="{{$user_id}}" class="form-control" />
                            </div> 

                            
                            <div class="col-3">
                                <label for="client" class="col-form-label text-start">Warehouse</label>         
                                <select class="form-control select2bs4" id="warehouse_id" name="warehouse_id" style="width: 100%;">
                                    <option value="">--Select--</option>
                                    @foreach($warehouses as $warehouse)
                                    <option value="{{$warehouse->id}}">{{$warehouse->warehouse_name}}</option>
                                    @endforeach
                                </select>
                            </div> 
                                               
                            </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3 row">
                            <div class="col-6">
                                <label for="client" class="col-form-label text-start">Supplier</label>         
                                <select class="form-control select2bs4" id="supplier_id" required name="supplier_id" style="width: 100%;">
                                    <option value="">--Select--</option>
                                    <option value="new">New Supplier</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{$supplier->id}}">{{$supplier->full_name}}</option>
                                    @endforeach
                                </select>
                            </div>                          
                            <div class="col-6" style="display: none" id="new_supplier">
                                <button type="button" style="margin-top: 35px" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-supplier">
                                    Add New Supplier
                                </button>
                            </div>
    
                            <!-- modal supplier start -->
                            <div class="modal fade" id="modal-supplier">
                                <div class="modal-dialog modal-lg">        
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color:blueviolet">Supplier Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Supplier Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Supplier Name" id="full_name" name="full_name" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
    
                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Mobile Number <small style="color: red">*</small></label>
                                        <input type="text" placeholder="016xxxxxxxx" id="mobile_number" name="mobile_number" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
    
                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Address <small style="color: red">*</small></label>
                                        <textarea name="official_address" id="official_address"  class="form-control form-control-lg"></textarea>
                                        </div> 
                                    </div>                                   
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-danger btn-lg float-right" data-dismiss="modal">Close</button>
                                </div>
                                </div>
                                </div> 
                            </div>
                        <!-- modal supplier ends -->
                            </div>
                    </div>           
                
                                        
                <div class="col-12 col-md-12">
                    <div class="mb-3 row">     
                        <div class="col-md-12 mt-4">
                            <table class="table table-bordered nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">               
                                <tbody>
                                    {{-- test start  --}}
                                    <div id="form-container">
                                        <div class="form-row">
                                            <div class="row" style="width: 100%">
                                                <div class="form-group col-2">
                                                    <label for="product_track_id" class="col-form-label text-start">Product Track ID</label>
                                                    <input type="text" readonly class="form-control product_track_id" name="product_track_id[]">
                                                </div>

                                                <div class="form-group col-2">
                                                    <label for="product_name" class="col-form-label text-start">Product Name</label>
                                                    {{-- <input type="text" class="form-control" name="product_name[]" placeholder="Product Name"> --}}
                                                    <select name="product_id[]" class="form-control select2bs4 product_name">
                                                        <option>--Select--</option>
                                                        @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select> 
                                                </div>

                                                <div class="form-group col-1">
                                                    <label for="product_weight" class="col-form-label text-start">Product Weight</label>
                                                    <input type="text" readonly class="form-control product_weight" name="product_weight[]"> 
                                                </div>
                                    
                                                <div class="form-group col-1">
                                                <label for="product_unit_type" class="col-form-label text-start">Unit</label>
                                                <input type="text" readonly class="form-control product_unit_type" name="product_unit_type[]">
                                                {{-- <select  name="product_unit_type[]" class="form-control select2bs4 product_unit_type">
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
                                                </select>   --}}
                                                </div>
                                    
                                                <div class="form-group col-2">
                                                <label for="product_details" class="col-form-label text-start">Product Details</label>
                                                <textarea readonly name="product_details[]" class="form-control product_details"></textarea>
                                                </div>
                                    
                                                <div class="form-group col-1">
                                                <label for="product_quantity" class="col-form-label text-start">Quantity</label>
                                                <input type="number" required class="form-control product_quantity" name="product_quantity[]">
                                                </div>
                                                
                                                <div class="form-group col-1">
                                                <label for="product_unit_price" class="col-form-label text-start">Unit Price</label>
                                                <input type="number" required class="form-control product_unit_price" name="product_unit_price[]">
                                                </div>
                                    
                                                <div class="form-group col-1">
                                                <label for="product_subtotal" class="col-form-label text-start">Sub Total (BDT)</label>
                                                <input type="text" readonly class="form-control product_subtotal" name="product_subtotal[]">
                                                </div>
                                                
                                                <div class="form-group">
                                                <a style="margin-top: 35px" class="btn btn-success" id="addButton">Add</a>   
                                                </div>

                                                </div> 
                                                {{-- row ends  --}}                                             
                                        </div>
                                    </div>                               
                                    {{-- test ends  --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                    <div class="form-group col-5">
                        
                    </div>

                    <div class="form-group col-4">
                       
                    </div>

                    <div class="form-group col-3">
                        <label class="col-form-label" style="color: green">Total Amount (BDT)</label>
                        <input type="text" readonly style="background-color: #e7ffd9" class="form-control" id="totalAmount" name="total_amount">
                    </div>
            
                    <div class="col-12"> 
                        <br>     
                        <button type="submit" class="btn btn-primary btn-lg float-right">Submit</button>          
                    </div>
        </div>     
        </form> 
        {{-- form ends  --}}

            </div> <!--end of card body -->
            </div> <!--end of card -->
        </div> <!-- end of col -->
        </div> <!-- end of row -->   
        
      </div>


      </div> <!-- /.container-fluid -->     
    </div> <!-- /.content-header -->      
  </div> <!-- /.content-wrapper -->   
@endsection

@push('masterScripts')
<script>
$(document).ready(function() {      
//Initialize Select2 Elements
$('.select2bs4').select2({
    theme: 'bootstrap4'
    });
//order id pattern
const orderIdField = document.getElementById("requisition_order_id");
orderIdField.value = generateOrderID();


$('#supplier_id').change(function() {
    if ($(this).val() === 'new') {
        $('#new_supplier').show();
    } else {
        $('#new_supplier').hide();
        $('#full_name').val('');
        $('#mobile_number').val('');
        $('#official_address').val('');
    }
});
});

//-----------------dynamic add new row start----------------------
function generateOrderID() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const milliseconds = String(now.getMilliseconds()).padStart(3, '0');

            // Example format: ORD-YYYYMMDD-HHMMSS-SSS
            const orderID = `ORD-${year}${month}${day}-${hours}${minutes}${seconds}-${milliseconds}`;
            return orderID;
        }


document.getElementById('addButton').addEventListener('click', function() { 
        const container = document.getElementById('form-container');
        const newRow = document.createElement('div');
        newRow.className = 'form-row';
        newRow.innerHTML = `<div class="row" style="width: 100%">

                            <div class="form-group col-2">
                                <label for="product_track_id" class="col-form-label text-start">Product Track ID</label>
                                <input type="text" readonly class="form-control product_track_id" id="product_track_id" name="product_track_id[]">
                            </div>
                            <div class="form-group col-2">
                                <label for="product_name" class="col-form-label text-start">Product Name</label>
                                <select name="product_id[]" class="form-control select2bs4 pro_name">
                                    <option>--Select--</option>
                                    @foreach($products as $product)
                                    <option value="{{$product->id}}">{{$product->product_name}}</option>
                                    @endforeach
                                </select> 
                            </div>

                             <div class="form-group col-1">
                                <label for="product_weight" class="col-form-label text-start">Product Weight</label>
                                <input type="text" readonly class="form-control product_weight" name="product_weight[]"> 
                            </div>
                
                            <div class="form-group col-1">
                            <label for="product_unit_type" class="col-form-label text-start">Unit</label>
                            <input type="text" readonly class="form-control product_unit_type" name="product_unit_type[]">
                             
                            </div>
                
                            <div class="form-group col-2">
                            <label for="product_details" class="col-form-label text-start">Product Details</label>
                            <textarea readonly name="product_details[]" class="form-control product_details"></textarea>
                            </div>
                
                            <div class="form-group col-1">
                            <label for="product_quantity" class="col-form-label text-start">Quantity</label>
                            <input type="number" class="form-control product_quantity" name="product_quantity[]">
                            </div>
                                
                            <div class="form-group col-1">
                            <label for="product_unit_price" class="col-form-label text-start">Unit Price</label>
                            <input type="number"  class="form-control product_unit_price" name="product_unit_price[]">
                            </div>
                
                            <div class="form-group col-1">
                            <label for="product_subtotal" class="col-form-label text-start">Sub Total (BDT)</label>
                            <input type="text" readonly class="form-control product_subtotal" name="product_subtotal[]">
                            </div>
                            
                            <div class="form-group">                                        
                            <button style="margin-top:35px !important" class="remove-button btn btn-danger">x</button>   
                            </div>
                        </div>                                         
                    `;
        container.appendChild(newRow);
        newRow.querySelector('.remove-button').addEventListener('click', function() {
            newRow.remove();
            updateTotal();
        });

        newRow.querySelectorAll('.product_quantity, .product_unit_price').forEach(function(input) {
            input.addEventListener('input', function() {
                calculateProductUnitPrice(newRow);
                generateProductTrackID(newRow);
                updateTotal();
            });
        });



    //for new added row dynamic product dependancy dropdown logic start
    newRow.querySelector('.pro_name').addEventListener('change',function(event){
    event.preventDefault();
    const selectedProductId = this.value;

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }
    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.get('sanctum/csrf-cookie').then(response=>{
    axios.post('/osms/api/product_information_dependancy',{
            data: selectedProductId
        }).then(response=>{
            var data = response;
                    newRow.querySelector('.product_unit_type').value = data.data.product_unit_type;
                    newRow.querySelector('.product_details').value = data.data.product_details;
                    newRow.querySelector('.product_weight').value = data.data.product_weight;
            console.log(response.data);
        });
    });
    });
    //for new added row dynamic product dependancy dropdown logic end

    });



    function calculateProductUnitPrice(row) {
        var productQuantity = $(row).find(".product_quantity").val();
        var productUnitPrice = $(row).find(".product_unit_price").val();
       
        var subtotal = (parseFloat(productQuantity) * parseFloat(productUnitPrice));
        $(row).find(".product_subtotal").val(subtotal ? subtotal.toFixed(2) : 0.00);
    }


    function generateProductTrackID(row) {
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
        
        $(row).find(".product_track_id").val(orderID);
    }

    function updateTotal() {       
        var total = 0;
        $('.product_subtotal').each(function() {
            var subtotal = parseFloat($(this).val());
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });
        $('#totalAmount').val(total.toFixed(2));
    }

    // Initialize event listeners for the initial row
    document.querySelectorAll('.product_quantity, .product_unit_price').forEach(function(input) {
        input.addEventListener('input', function() {
            var row = input.closest('.form-row');
            calculateProductUnitPrice(row);
            generateProductTrackID(row);
            updateTotal();
        });
    });

//----------------------dynamic add new row end-----------------------



//product dependancy dropdown logic start
$('.product_name').on('change',function(event){
  event.preventDefault();
  var selectedProduct = $('.product_name').val();

  if (selectedProduct == '') {
        $('.product_weight').val('');
        $('.product_unit_type').val('');
        $('.product_details').html('');
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
 axios.post('/osms/api/product_information_dependancy',{
        data: selectedProduct
      }).then(response=>{
        // Update the select element for product_unit_type
        $('.product_unit_type').val(response.data.product_unit_type);
        // Update the input element for product_details
        $('.product_details').val(response.data.product_details);
        // Update the input element for product_weight
        $('.product_weight').val(response.data.product_weight);
        console.log(response.data);
      });
 });
});
//product dependancy dropdown logic end



//..............requisition purchase order submit start................
document.getElementById('requisitionOrderForm').addEventListener('submit',function(event){
event.preventDefault();
var requisitionOrderFormData = new FormData(this);

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }

// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/requisition_store',requisitionOrderFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
        window.location.href = "{{ route('requisition_list') }}";
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
//................requisition purchase order submit end.................
 
</script>
 @endpush

