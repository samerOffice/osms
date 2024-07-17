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
                        <h4 class="card-title ">Edit Request</h4>
                    </div>

                <div class="card-body" >
                {{-- form starts  --}}
                <div id="form-container">
                    <!-- Rows will be added here dynamically -->
                </div>
                <button class="add-button" id="addButton">Add</button>
                
                <div class="total">Total: <span id="totalAmount">0.00</span> BDT</div>
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
            addRow({});
        });
    });

    function fetchProductData() {
        // $.ajax({
        //     url: '/your-api-endpoint',
        //     method: 'GET',
        //     success: function(response) {
        //         response.forEach(function(product) {
        //             addRow({
        //                 trackId: product.product_track_id,
        //                 productName: product.requested_product_name,
        //                 productWeight: product.requested_product_weight,
        //                 unit: product.requested_product_unit_type,
        //                 productDetails: product.requested_product_details,
        //                 quantity: product.requested_product_quantity,
        //                 unitPrice: product.requested_product_unit_price
        //             });
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //         console.error('Failed to fetch product data:', error);
        //     }
        // });



        // Function to get CSRF token from meta tag
        function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

        // Set up Axios defaults
        axios.defaults.withCredentials = true;
        axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

        // axios.get('sanctum/csrf-cookie').then(response=>{
        axios.get('/osms/api/requisition_edit').then(response=>{
            response.forEach(function(product) {
                    addRow({
                        trackId: product.product_track_id,
                        productName: product.requested_product_name,
                        productWeight: product.requested_product_weight,
                        unit: product.requested_product_unit_type,
                        productDetails: product.requested_product_details,
                        quantity: product.requested_product_quantity,
                        unitPrice: product.requested_product_unit_price
                    });
                });
                
        }).catch(error => Swal.fire({
                    icon: "error",
                    title: error.response.data.message.email,
                    }))
        // });

    }

    function addRow(data) {
        const container = $('#form-container');
        const newRow = $(`
            <div class="form-row">
                <input type="text" name="productTrackId" placeholder="Product Track ID" value="${data.trackId || ''}" readonly>
                <input type="text" name="productName" placeholder="Product Name" value="${data.productName || ''}">
                <input type="number" name="productWeight" placeholder="Product Weight" value="${data.productWeight || ''}">
                <select name="unit">
                    <option>--Select--</option>
                    <option value="Liter" ${data.unit === 'Liter' ? 'selected' : ''}>Liter</option>
                    <option value="Kg" ${data.unit === 'Kg' ? 'selected' : ''}>Kg</option>
                </select>
                <textarea name="productDetails" placeholder="Product Details">${data.productDetails || ''}</textarea>
                <input type="number" name="productQuantity" class="product_quantity" placeholder="Quantity" value="${data.quantity || ''}">
                <input type="number" name="productUnitPrice" class="product_unit_price" placeholder="Unit Price" value="${data.unitPrice || ''}">
                <div class="product_subtotal">${data.quantity && data.unitPrice ? (data.quantity * data.unitPrice).toFixed(2) : '--'}</div>
                <button type="button" class="remove-button">x</button>
            </div>
        `);

        container.append(newRow);

        newRow.find('.remove-button').on('click', function() {
            newRow.remove();
            updateTotal();
        });

        newRow.find('.product_quantity, .product_unit_price').on('input', function() {
            calculateProductUnitPrice(newRow);
            updateTotal();
        });

        calculateProductUnitPrice(newRow);
        updateTotal();
    }

    function calculateProductUnitPrice(row) {
        var productQuantity = $(row).find(".product_quantity").val();
        var productUnitPrice = $(row).find(".product_unit_price").val();
       
        var subtotal = (parseFloat(productQuantity) * parseFloat(productUnitPrice));
        if (!isNaN(subtotal)) {
            $(row).find(".product_subtotal").text(subtotal.toFixed(2)).data('subtotal', subtotal);
        } else {
            $(row).find(".product_subtotal").text('--').data('subtotal', 0);
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
        $('#totalAmount').text(total.toFixed(2));
    }
</script>
 @endpush

