@extends('master')

@section('title')
New Sale
@endsection

@section('content')
  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">  
                    
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-outline-info float-right" href="">
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
                        <h4 class="card-title ">Add New Sale</h4>
                    </div>

                <div class="card-body" >
                {{-- form starts  --}}
                <form id="saleForm" enctype="multipart/form-data">
                <div class="row" style=" margin: 0 10px; padding: 10px;"> 
                    <div class="col-12">
                        <div class="mb-3 row">
                            <div class="col-4">
                                <label  class="col-form-label text-start">Invoice Number</label>         
                                <input type="text" readonly style="background-color: #e7ffd9" id="sale_order_id" name="sale_order_id" class="form-control" />
                            </div>
    
                            <div class="col-4">
                                <label  class="col-form-label text-start">Purchase Date</label>         
                                <input type="date" readonly style="background-color: #e7ffd9" id="requisition_order_date" name="requisition_order_date" value="{{ date('Y-m-d') }}" class="form-control" />
                            </div> 

                            <div class="col-4">
                                <label  class="col-form-label text-start">Sale By</label>         
                                <input type="text" readonly style="background-color: #e7ffd9" id="sale_by_name" name="sale_by_name" value="{{$user_name}}" class="form-control" />
                                <input type="hidden" id="sale_by" name="sale_by" value="{{$user_id}}" class="form-control" />
                            </div>                                               
                            </div>
                    </div>

                    <div class="col-12">
                        <div class="mb-3 row">

                        <div class="col-3">
                                <label for="client" class="col-form-label text-start">Payment Method</label>         
                                <select class="form-control select2bs4" id="payment_id" name="payment_id" style="width: 100%;">
                                    <option value="">--Select--</option>
                                    <option value="1">Cash</option>
                                </select>
                        </div>
                        
                        <div class="col-4">
                                <label for="client" class="col-form-label text-start">Outlet</label>         
                                <select class="form-control select2bs4" id="outlet_id" name="outlet_id" style="width: 100%;">
                                    <option value="">--Select--</option>
                                    @foreach($outlets as $outlet)
                                    <option value="{{$outlet->id}}">{{$outlet->outlet_name}}</option>
                                    @endforeach
                                </select>
                        </div>

                            <div class="col-3">
                                <label for="client" class="col-form-label text-start">Customer</label>         
                                <select class="form-control select2bs4" id="customer_id" name="customer_id" style="width: 100%;">
                                    <option value="">--Select--</option>
                                    <option value="new">New Customer</option>
                                    @foreach($customers as $customer)                                 

                                    <option value="{{$customer->id}}">{{$customer->customer_name}} ({{$customer->customer_phone_number}})</option>

                                    @endforeach
                                </select>
                            </div>                          
                            <div class="col-2" style="display: none" id="new_customer">
                                <button type="button" style="margin-top: 35px" class="btn btn-outline-info" data-toggle="modal" data-target="#modal-customer">
                                    Add New Customer
                                </button>
                            </div>
    
                            <!-- modal customer start -->
                            <div class="modal fade" id="modal-customer">
                                <div class="modal-dialog modal-lg">        
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" style="color:blueviolet">Customer Details</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Customer Name <small style="color: red">*</small></label>
                                        <input type="text" placeholder="Customer Name" id="customer_name" name="customer_name" class="form-control form-control-lg" />
                                        </div> 
                                    </div>
    
                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Mobile Number <small style="color: red">*</small></label>
                                        <input type="text" placeholder="016xxxxxxxx" id="customer_phone_number" name="customer_phone_number" class="form-control form-control-lg" />
                                        </div> 
                                    </div>


                                    <div class="col-md-12 col-sm-12">
                                        <div data-mdb-input-init class="form-outline mb-4">
                                        <label>Email</label>
                                        <input type="email"  id="customer_email" name="customer_email" class="form-control form-control-lg" />
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
                        <!-- modal customer ends -->
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
                                                <div class="form-group col-3">
                                                    <label for="sku" class="col-form-label text-start">SKU</label>
                                                    <input type="text" placeholder="Type SKU Number" onkeyup="skuDetails()" class="form-control sku" name="sku[]">
                                                    <input type="hidden" placeholder="Type SKU Number" class="form-control stock_product_id" name="stock_product_id[]">
                                                </div>

                                                <div class="form-group col-3">
                                                    <label for="product_name" class="col-form-label text-start">Product</label>
                                                    <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_name" name="product_name[]" >
                                                    {{-- <select name="product_id[]" class="form-control select2bs4 product_name">
                                                        <option>--Select--</option>
                                                        @foreach($products as $product)
                                                        <option value="{{$product->id}}">{{$product->product_name}}</option>
                                                        @endforeach
                                                    </select>  --}}
                                                </div>

                                                <div class="form-group col-1">
                                                    <label for="product_weight"  class="col-form-label text-start">Weight</label>
                                                    <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_weight" name="product_weight[]"> 
                                                </div>
                                    
                                                <div class="form-group col-1">
                                                <label for="product_unit_type" class="col-form-label text-start">Unit</label>
                                                <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_unit_type" name="product_unit_type[]">
                                                </div>
                                    
                                                <div class="form-group col-4">
                                                <label for="product_details" class="col-form-label text-start">Details</label>
                                                <textarea readonly style="background-color: #e7ffd9" name="product_details[]" class="form-control product_details"></textarea>
                                                </div>

                                                <div class="form-group col-2">
                                                    <label for="product_mfg_date" class="col-form-label text-start">MFG Date</label>
                                                    <input type="date" readonly style="background-color: #e7ffd9" class="form-control product_mfg_date" name="product_mfg_date[]"> 
                                                </div>
                    
                                                <div class="form-group col-2">
                                                    <label for="product_expiry_date" class="col-form-label text-start">Expiry Date</label>
                                                    <input type="date" readonly style="background-color: #e7ffd9" class="form-control product_expiry_date" name="product_expiry_date[]"> 
                                                </div>
                                    
                                                <div class="form-group col-2">
                                                <label for="product_quantity" class="col-form-label text-start">Quantity</label>
                                                <input type="number" required  class="form-control product_quantity" onkeyup="availableQuantityCheck()"  name="product_quantity[]">
                                                </div>
                                                
                                                <div class="form-group col-2">
                                                <label for="product_unit_price" class="col-form-label text-start">Unit Price</label>
                                                <input type="text" readonly  style="background-color: #e7ffd9" class="form-control product_unit_price" name="product_unit_price[]">
                                                </div>
                                    
                                                <div class="form-group col-2">
                                                <label for="product_subtotal" class="col-form-label text-start">Sub Total</label>
                                                <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_subtotal" name="product_subtotal[]">
                                                </div>
                                                
                                                <div class="form-group">
                                                <a style="margin-top: 35px; color:white" class="btn btn-lg btn-info" id="addButton"><i class="fas fa-plus"></i></a>   
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

                    <!-- total amount start -->
                    <div class="form-group col-4"></div>
                    <div class="form-group col-4" style="padding-left: 160px">
                    <label class="col-form-label">Total Amount (BDT)</label>
                    </div>
                    <div class="form-group col-4">                   
                    <input type="text" readonly style="background-color: #e7ffd9" class="form-control" id="totalAmount" name="total_amount">
                    </div>
                    <!-- total amount end -->

                     <!-- TAX amount start -->
                     <div class="form-group col-4"></div>
                    <div class="form-group col-4" style="padding-left: 160px">
                    <label class="col-form-label">Tax (BDT)</label>
                    </div>
                    <div class="form-group col-4">                   
                    <input type="text"  class="form-control" id="taxAmount" onkeyup="taxAmountCalculation()" name="tax_amount">
                    </div>
                    <!-- TAX amount end -->

                    <!-- Discount amount start -->
                    <div class="form-group col-4"></div>
                    <div class="form-group col-4" style="padding-left: 160px">
                    <label class="col-form-label">Discount (BDT)</label>
                    </div>
                    <div class="form-group col-4">                   
                    <input type="text"  class="form-control" id="discountAmount" onkeyup="discountAmountCalculation()" name="discount_amount">
                    </div>
                    <!-- Discount amount end -->

                     <!-- Grand Total start -->
                     <div class="form-group col-4"></div>
                    <div class="form-group col-4" style="padding-left: 160px">
                    <label class="col-form-label" >Grand Total (BDT)</label>
                    </div>
                    <div class="form-group col-4">                   
                    <input type="text" readonly style="background-color: powderblue"  class="form-control" id="grandTotal" name="grand_total">
                    </div>
                    <!-- Grand Total end -->


                     <!-- Due amount start -->
                     <div class="form-group col-4"></div>
                     <div class="form-group col-4" style="padding-left: 160px">
                     <label class="col-form-label" style="color: red">Due (BDT)</label>
                     </div>
                     <div class="form-group col-4">                   
                     <input type="text"  class="form-control" id="dueAmount" onkeyup="dueAmountCalculation()" name="due_amount">
                     </div>
                     <!-- Due amount end -->


                    <!-- Paid amount start -->
                    <div class="form-group col-4"></div>
                    <div class="form-group col-4" style="padding-left: 160px">
                    <label class="col-form-label" style="color:green">Paid (BDT)</label>
                    </div>
                    <div class="form-group col-4">                   
                    <input type="text" readonly  class="form-control" id="paidAmount" name="paid_amount">
                    </div>
                    <!-- Paid amount end -->


                   


                    

                   
                    
            
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
const orderIdField = document.getElementById("sale_order_id");
orderIdField.value = generateOrderID();


$('#customer_id').change(function() {
    if ($(this).val() === 'new') {
        $('#new_customer').show();
    } else {
        $('#new_customer').hide();
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
            const orderID = `INVOICE-${year}${month}${day}-${hours}${minutes}${seconds}-${milliseconds}`;
            return orderID;
        }


document.getElementById('addButton').addEventListener('click', function() { 
        const container = document.getElementById('form-container');
        const newRow = document.createElement('div');
        newRow.className = 'form-row';
        newRow.innerHTML = `<div class="row" style="width: 100%; margin-top: 70px !important;">

                            <div class="form-group col-3">
                                <label for="sku" class="col-form-label text-start">SKU</label>
                                 <input type="text" placeholder="Type SKU Number" onkeyup="skuDetailsForDynamicRow()" class="form-control sku" name="sku[]">
                                <input type="hidden" placeholder="Type SKU Number" class="form-control stock_product_id" name="stock_product_id[]">
                            </div>
                            <div class="form-group col-3">
                                <label for="product_name" class="col-form-label text-start">Product</label>
                                 <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_name" name="product_name[]" >
                            </div>

                            <div class="form-group col-1">
                                <label for="product_weight" class="col-form-label text-start">Weight</label>
                                <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_weight" name="product_weight[]"> 
                            </div>
                
                            <div class="form-group col-1">
                            <label for="product_unit_type" class="col-form-label text-start">Unit</label>
                            <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_unit_type" name="product_unit_type[]">
                             
                            </div>
                
                            <div class="form-group col-4">
                            <label for="product_details" class="col-form-label text-start">Details</label>
                            <textarea readonly style="background-color: #e7ffd9" name="product_details[]" class="form-control product_details"></textarea>
                            </div>

                            <div class="form-group col-2">
                            <label for="product_mfg_date" class="col-form-label text-start">MFG Date</label>
                            <input type="date" readonly style="background-color: #e7ffd9" class="form-control product_mfg_date" name="product_mfg_date[]"> 
                            </div>
                    
                            <div class="form-group col-2">
                            <label for="product_expiry_date" class="col-form-label text-start">Expiry Date</label>
                            <input type="date" readonly style="background-color: #e7ffd9" class="form-control product_expiry_date" name="product_expiry_date[]"> 
                            </div>

                
                            <div class="form-group col-2">
                            <label for="product_quantity" class="col-form-label text-start">Quantity</label>
                            <input type="number" class="form-control product_quantity" name="product_quantity[]">
                            </div>
                                
                            <div class="form-group col-2">
                            <label for="product_unit_price" class="col-form-label text-start">Unit Price</label>
                            <input type="number" readonly style="background-color: #e7ffd9"  class="form-control product_unit_price" name="product_unit_price[]">
                            </div>
                
                            <div class="form-group col-2">
                            <label for="product_subtotal" class="col-form-label text-start">Sub Total</label>
                            <input type="text" readonly style="background-color: #e7ffd9" class="form-control product_subtotal" name="product_subtotal[]">
                            </div>
                            
                            <div class="form-group">                                        
                            <button style="margin-top:35px !important; color: white" class="remove-button btn btn-danger">x</button>   
                            </div>
                        </div>                                         
                    `;
        container.appendChild(newRow);
        newRow.querySelector('.remove-button').addEventListener('click', function() {
            newRow.remove();
            updateTotal();
        });

        newRow.querySelector('.sku').addEventListener('input', function() {
                skuDetailsForDynamicRow(newRow);
            });

        newRow.querySelectorAll('.product_quantity, .product_unit_price').forEach(function(input) {
            input.addEventListener('input', function() {
                availableQuantityCheckForDynamicProduct(newRow);
                calculateProductUnitPrice(newRow);
                updateTotal();
            });
        });


        //-----------------dynamic sku product dependancy logic start------------- 
            function skuDetailsForDynamicRow(row){   
                const selectedDynamicSku = $(row).find(".sku").val();

                // Clear fields initially
                clearDynamicProductFields(newRow);
               
                if (selectedDynamicSku == '') {
                    return false;
                }

                // Function to get CSRF token from meta tag
                function getCsrfToken() {
                    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                }

                // Set up Axios defaults
                axios.defaults.withCredentials = true;
                axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

                axios.get('sanctum/csrf-cookie').then(response => {
                    axios.post('/api/sku_product_information_dependancy', {
                        data: selectedDynamicSku
                    }).then(response => {
                        if (response.data && response.data.product_name) {

                            newRow.querySelector('.product_name').value = response.data.product_name;
                            newRow.querySelector('.product_weight').value = response.data.product_weight;
                            newRow.querySelector('.product_unit_type').value = response.data.product_unit_type;
                            newRow.querySelector('.product_details').value = response.data.product_details;
                            newRow.querySelector('.product_mfg_date').value = response.data.product_mfg_date;
                            newRow.querySelector('.product_expiry_date').value = response.data.product_expiry_date;
                            newRow.querySelector('.product_unit_price').value = response.data.product_unit_price;
                            newRow.querySelector('.stock_product_id').value = response.data.stock_id;

                            availableDynamicStock = response.data.product_quantity;
                        }
                        console.log(response.data);
                    }).catch(error => {
                        console.error('Error fetching product information:', error);
                    });
                });
            }

            function availableQuantityCheckForDynamicProduct(row) {
                    const enteredDynamicQuantity = row.querySelector('.product_quantity').value;
                    if (enteredDynamicQuantity > availableDynamicStock) {
                        alert('Not enough stock available!');
                        row.querySelector('.product_quantity').value = '';
                    }
                }

            function clearDynamicProductFields(row){             
                row.querySelector('.product_name').value = '';
                row.querySelector('.product_weight').value = '';
                row.querySelector('.product_unit_type').value = '';
                row.querySelector('.product_details').value = '';
                row.querySelector('.product_mfg_date').value = '';
                row.querySelector('.product_expiry_date').value = '';
                row.querySelector('.product_unit_price').value = '';
                row.querySelector('.product_subtotal').value = '';              
            }

            function availableQuantityCheckForDynamicProduct(row) {
               
                const enteredDynamicQuantity = $(row).find(".product_quantity").val();
               
                if (enteredDynamicQuantity > availableDynamicStock) {
                    // alert('Not enough stock available!');
                    Swal.fire({
                    icon: "warning",
                    title: 'Not enough stock available!',
                    });
                    $(row).find(".product_quantity").val('');
                }
            }


//--------------dynamic sku product dependancy logic end--------------------

});


function calculateProductUnitPrice(row) {
        var productQuantity = $(row).find(".product_quantity").val();
        var productUnitPrice = $(row).find(".product_unit_price").val();
       
        var subtotal = (parseFloat(productQuantity) * parseFloat(productUnitPrice));
        $(row).find(".product_subtotal").val(subtotal ? subtotal.toFixed(2) : 0.00);
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
        $('#paidAmount').val(total.toFixed(2));
        $('#grandTotal').val(total.toFixed(2));
    }

    // Initialize event listeners for the initial row
    document.querySelectorAll('.product_quantity, .product_unit_price').forEach(function(input) {
        input.addEventListener('input', function() {
            var row = input.closest('.form-row');
            calculateProductUnitPrice(row);
            // generateProductTrackID(row);
            updateTotal();
        });
    });


//----------------------dynamic add new row end-----------------------




//--------------------initial sku product dependancy logic start---------------
let availableStock = 0;
function skuDetails(){
    var selectedSku = $('.sku').val();

    // Clear fields initially
    clearProductFields();
    availableStock = 0;

    if (selectedSku == '') {
        return false;
    }

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.get('sanctum/csrf-cookie').then(response => {
        axios.post('/api/sku_product_information_dependancy', {
            data: selectedSku
        }).then(response => {
            if (response.data && response.data.product_name) {
                $('.product_name').val(response.data.product_name);    
                $('.product_weight').val(response.data.product_weight);
                $('.product_unit_type').val(response.data.product_unit_type);
                $('.product_details').val(response.data.product_details);
                $('.product_mfg_date').val(response.data.product_mfg_date);
                $('.product_expiry_date').val(response.data.product_expiry_date);
                $('.product_unit_price').val(response.data.product_unit_price);
                $('.stock_product_id').val(response.data.stock_id);
                availableStock = response.data.product_quantity;
            }
            console.log(response.data);
        }).catch(error => {
            console.error('Error fetching product information:', error);
        });
    });
}

function availableQuantityCheck() {
    var enteredQuantity = parseInt($('.product_quantity').val());
    if (enteredQuantity > availableStock) {
        // alert('Not enough stock available!');
        Swal.fire({
                    icon: "warning",
                    title: 'Not enough stock available!',
                    });
        parseInt($('.product_quantity').val(''));
    }
}

function clearProductFields(){
    $('.product_name').val('');
    $('.product_weight').val('');
    $('.product_unit_type').val('');
    $('.product_details').val('');
    $('.product_mfg_date').val('');
    $('.product_expiry_date').val('');
    $('.product_unit_price').val('');
    $('.product_subtotal').val('');
}

//-------------initial sku product dependancy logic end-----------------



//----- Tax amount Calculation start
function taxAmountCalculation(){
    var total_amount = parseInt($('#totalAmount').val());
    var tax_amount = $('#taxAmount').val(); // Get the value as a string first

    var grand_total = total_amount - tax_amount

    if(tax_amount === ''){
        $('#paidAmount').val(total_amount.toFixed(2));
        $('#grandTotal').val(total_amount.toFixed(2));
    }else{
        tax_amount = parseInt(tax_amount); // Parse tax_amount only if it's not empty
        var grand_total = total_amount + tax_amount;
        $('#paidAmount').val(grand_total.toFixed(2));
        $('#grandTotal').val(grand_total.toFixed(2));
        
    }
}
//----- Tax amount Calculation end



//----- Discount amount Calculation start
function discountAmountCalculation(){

    var total_amount = $('#totalAmount').val();
    var tax_amount = $('#taxAmount').val();
    var discount_amount = $('#discountAmount').val();

    if(discount_amount === ''){

        if(tax_amount === ''){
            total_amount = parseInt(total_amount);
            $('#paidAmount').val(total_amount.toFixed(2));
            $('#grandTotal').val(total_amount.toFixed(2));
        }else{
            total_amount = parseInt(total_amount);
            tax_amount = parseInt(tax_amount);
            var amount_with_tax = total_amount + tax_amount;
            $('#paidAmount').val(amount_with_tax.toFixed(2));
            $('#grandTotal').val(amount_with_tax.toFixed(2));
        }
       
    }else{

        if(tax_amount === ''){
            total_amount = parseInt(total_amount);
            discount_amount = parseInt(discount_amount);

            var grand_total = total_amount - discount_amount;
            $('#paidAmount').val(grand_total.toFixed(2));
            $('#grandTotal').val(grand_total.toFixed(2));
        }else{
            total_amount = parseInt(total_amount);
            tax_amount = parseInt(tax_amount);
            discount_amount = parseInt(discount_amount);

            var amount_with_tax = total_amount + tax_amount;
            var grand_total = amount_with_tax - discount_amount;
            $('#paidAmount').val(grand_total.toFixed(2));
            $('#grandTotal').val(grand_total.toFixed(2));
        }
    
    }
}
//----- Discount amount Calculation end



//----- Due amount Calculation start
function dueAmountCalculation(){

    var total_amount = parseInt($('#totalAmount').val());
    var due_amount = $('#dueAmount').val(); // Get the value as a string first

    if(due_amount === ''){
        var grand_total = parseInt($('#grandTotal').val());
        $('#paidAmount').val(grand_total.toFixed(2));
    }else{
        
        due_amount = parseInt(due_amount); // Parse tax_amount only if it's not empty

        var grand_total = parseInt($('#grandTotal').val());

        var paid_amount = grand_total - due_amount;
        
        $('#paidAmount').val(paid_amount.toFixed(2));
        // $('#grandTotal').val(grand_total.toFixed(2));
        
    }
}
//----- Due amount Calculation end




//..............requisition purchase order submit start................
document.getElementById('saleForm').addEventListener('submit',function(event){
event.preventDefault();
var saleFormData = new FormData(this);

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }

// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/sale_store',saleFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
        window.location.href = "{{ route('invoice_show_data', ':id') }}".replace(':id', response.data.invoice_id);
        // window.location.reload();
      }, 2000);
  Swal.fire({
              icon: "success",
              title: ''+ response.data.message,
            });
        return false;
        
  }).catch(error => Swal.fire({
              icon: "error",
              title: error.response.data,
              }))
 });

});
//................requisition purchase order submit end.................
 
</script>
 @endpush

