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
                    <div class="row">
                    <div class="col-12">
                    <div class="card" style="display: flex; justify-content: center; align-items: center;">
                    <div class="card-header">                                   
                        <h4 class="card-title ">Edit Purchase Request</h4>
                        <input type="hidden" id="orderId" name="" value="{{$id}}">
                    </div>

                <div class="card-body" >
                {{-- form starts  --}}
                <form id="requisitionOrderFormUpdate" enctype="multipart/form-data">
                <div id="form-container">
                    <!-- Rows will be added here dynamically -->
                </div>
                <button type="button" class="add-button btn btn-success" id="addButton">Add</button>
                
                <div class="row">
                    <div class="form-group col-5"></div>
                    <div class="form-group col-4"></div>
                    <div class="form-group col-3">
                        <label class="col-form-label" style="color: green">Total Amount (BDT)</label>
                        <input type="text" readonly style="background-color: #e7ffd9" class="form-control" id="totalAmount" name="total_amount">
                    </div>
                </div>

                <div class="col-12"> 
                    <br>     
                    <button type="submit" class="btn btn-primary btn-lg float-right">Submit</button>          
                </div>

                </form>           
            {{-- form ends  --}}

            </div> <!--end of card body -->
            </div> <!--end of card -->
        </div> <!-- end of col -->
        </div> <!-- end of row -->   
        

      </div> <!-- /.container-fluid -->     
    </div> <!-- /.content-header -->      
  </div> <!-- /.content-wrapper -->   
@endsection

@push('masterScripts')
<script>
  $(document).ready(function() {
        fetchProductData();
        $('#addButton').on('click', function() {
            fetchProductList().then(productList => {
                addRow({}, productList);
            });
        });
    });

    function fetchProductList() {
    return axios.get('/api/products') // Adjust the URL as needed
        .then(response => response.data)
        .catch(error => {
            console.error('Failed to fetch product list:', error);
            return [];
        });
    }

    function fetchProductData() {
        var requisition_order_id = document.getElementById('orderId').value;
        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        // axios.get('sanctum/csrf-cookie').then(response=>{
        axios.get('/api/requisition_edit/'+requisition_order_id).then(response=>{           
            if (Array.isArray(response.data)) {
                    response.data.forEach(function(product) {
                        console.log('Adding row for product:', product);
                        addRow({
                            trackId: product.product_track_id,
                            productId: product.requested_product_id,
                            productName: product.requested_product_name,
                            productWeight: product.requested_product_weight,
                            unit: product.requested_product_unit_type,
                            productDetails: product.requested_product_details,
                            productMFGDate: product.requested_product_mfg_date,
                            productExpiryDate: product.requested_product_expiry_date,
                            quantity: product.requested_product_quantity,
                            unitPrice: product.requested_product_unit_price
                        });
                    });
                } else {
                    console.error('Unexpected response format:', response);
                }

            console.log(response);
                
        }).catch(error => console.error('Failed to fetch product data:', error))
        // });

    }

    function addRow(data, productList = []) {

        const productOptions = `
        <option value="">Select</option>
        ${productList.map(product => 
            `<option value="${product.id}">${product.product_name}</option>`
        ).join('')}
    `;

        const container = $('#form-container');
        const newRow = $(`
            <div class="form-row">

                 <div class="form-group col-2">
                    <label for="product_track_id" class="col-form-label text-start">Product Track ID</label>
                    <input type="text" readonly class="form-control product_track_id" id="product_track_id"  value="${data.trackId || ''}" name="product_track_id[]">
                 </div>

                  <div class="form-group col-2">
                    <label for="product_name" class="col-form-label text-start">Product Name</label>
                    <select name="product_id[]" class="form-control select2bs4 product_name">
                    <option value="${data.productId || ''}">${data.productName || ''}</option>
                    ${productOptions}
                 </select>
                  </div>

                <div class="form-group col-1">
                    <label for="product_weight" class="col-form-label text-start">Weight</label>
                    <input type="text" readonly class="form-control product_weight" value="${data.productWeight || ''}" name="product_weight[]" > 
                </div>

                <div class="form-group col-1">
                    <label for="product_unit_type" class="col-form-label text-start">Unit</label>
                    <input type="text" readonly class="form-control product_unit_type" value="${data.unit || ''}" name="product_unit_type[]" > 
                </div>

                <div class="form-group col-6">
                    <label for="product_details" class="col-form-label text-start">Details</label>
                    <textarea readonly name="product_details[]" class="form-control product_details">${data.productDetails || ''}</textarea>
                </div>

                <div class="form-group col-2">
                    <label for="product_mfg_date" class="col-form-label text-start">MFG Date</label>
                    <input type="date" class="form-control product_mfg_date" value="${data.productMFGDate || ''}" name="product_mfg_date[]">
                </div>

                <div class="form-group col-2">
                    <label for="product_expiry_date" class="col-form-label text-start">Expiry Date</label>
                    <input type="date" class="form-control product_expiry_date" value="${data.productExpiryDate || ''}" name="product_expiry_date[]">
                </div>

                <div class="form-group col-2">
                    <label for="product_quantity" class="col-form-label text-start">Quantity</label>
                    <input type="number" class="form-control product_quantity" value="${data.quantity || ''}" name="product_quantity[]">
                </div>


               <div class="form-group col-2">
                    <label for="product_unit_price" class="col-form-label text-start">Unit Price</label>
                    <input type="number"  class="form-control product_unit_price" value="${data.unitPrice || ''}" name="product_unit_price[]">
               </div>

                <div class="form-group col-2">
                    <label for="product_subtotal" class="col-form-label text-start">Sub Total</label>
                    <input type="text" readonly class="form-control product_subtotal" value="${data.quantity && data.unitPrice ? (data.quantity * data.unitPrice).toFixed(2) : '--'}" name="product_subtotal[]" >
                </div>

                <div class="form-group">                                        
                    <button style="margin-top:35px !important" class="remove-button btn btn-danger">x</button>   
                </div>

               
            </div>
        `);

        container.append(newRow);
        newRow.find('.remove-button').on('click', function() {
            newRow.remove();
            updateTotal();
        });

        newRow.find('.product_quantity, .product_unit_price').on('input', function() {
            calculateProductUnitPrice(newRow);
            generateProductTrackID(newRow);
            updateTotal();
        });


        newRow.find('.product_name').on('change', function(event) {
        const selectedProductId = $(this).val();
        if (selectedProductId) {
            fetchProductDetails(selectedProductId, newRow);
        } else {
            // Clear the related fields if no product is selected
            newRow.find('.product_weight').val('');
            newRow.find('.product_unit_type').val('');
            newRow.find('.product_details').val('');
        }
    });

        calculateProductUnitPrice(newRow);
        updateTotal();
    }



    //-------------------------functions start -----------------------------


    function fetchProductDetails(productId, rowElement) {
    // Function to get CSRF token from meta tag
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    axios.post('/api/product_information_dependancy', { data: productId })
        .then(response => {

            console.log(response.data);
            const data = response.data;
            if (data) {
                rowElement.find('.product_weight').val(data.product_weight || '');
                rowElement.find('.product_unit_type').val(data.product_unit_type || '');
                rowElement.find('.product_details').val(data.product_details || '');
                // Update other fields if necessary
            } else {
                console.error('No data received for the selected product.');
            }
        })
        .catch(error => {
            console.error('Failed to fetch product details:', error);
        });
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

    function calculateProductUnitPrice(row) {
        var productQuantity = $(row).find(".product_quantity").val();
        var productUnitPrice = $(row).find(".product_unit_price").val();
       
        var subtotal = (parseFloat(productQuantity) * parseFloat(productUnitPrice));
        if (!isNaN(subtotal)) {
            $(row).find(".product_subtotal").val(subtotal.toFixed(2)).data('subtotal', subtotal);
        } else {
            $(row).find(".product_subtotal").val('--').data('subtotal', 0);
        }
    }

    function updateTotal() {
        var total = 0;
        $('.product_subtotal').each(function() {
            var subtotal = $(this).data('subtotal');
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });
        $('#totalAmount').val(total.toFixed(2));
    }

//----------------------- functions end ---------------------------

//requisition order update start
document.getElementById('requisitionOrderFormUpdate').addEventListener('submit',function(event){
  event.preventDefault();

var requisitionOrderFormUpdateData = new FormData(this);
var requisition_order_id = document.getElementById('orderId').value;

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }

// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

// axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/requisition_update/'+ requisition_order_id, requisitionOrderFormUpdateData).then(response=>{
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
              title: error.response.data.message,
              }))
 });

// });
//requisition order update end
</script>
 @endpush

