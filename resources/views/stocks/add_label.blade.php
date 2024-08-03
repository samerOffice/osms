@extends('master')

@section('title')
View label
@endsection

@push('css')
<style type="text/css">
    @media print {
        #barcode_print {
            display: none;
        }

        #sku_print {
            display: none;
        }
    }
</style>
@endpush
@section('content')
<div class="content-wrapper">
    <div class="container-fluid">
        <br>
        <div class="row">
            <div class="col-12">
                <a class="btn btn-outline-info float-right" href="{{route('stock_list')}}">
                    <i class="fas fa-list"></i> stock list
                </a>
            </div>                       
        </div>
        <br>

        <div class="row">

            <div class="col-12">            
                <div class="invoice p-3 mb-3" id="label_details">               
                  <h4>
                      <small class="float-left"><b>Date:</b> <span style="color: green">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span></small>
                  </h4>  
                  <br>                     
                </div>
              </div>
          
            <div class="col-12">               
            <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Stock Product Details</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <input type="text" id="stock_id" name="stock_id" value="{{$label->id}}">
                  <strong><i class="fas fa-file-alt mr-1"></i> Product Name : </strong><span id="product_name">{{$label->stock_product_name}}</span>
                  <hr>
                  <strong><i class="fa-solid fa-weight-hanging mr-1"></i> Product Weight : </strong><span>{{$label->stock_product_weight}} {{$label->stock_product_unit_type}}</span>
                  <hr>
                  <strong><i class="fas fa-pencil-alt mr-1"></i> Product Details : </strong><span>{{$label->stock_product_details}}</span>
                  <hr>
                  <strong><i class="far fa-file-alt mr-1"></i> Product Quantity : </strong><span id="product_quantity">{{$label->quantity}}</span>
                  <hr>
                  <strong><i class="fa-solid fa-bangladeshi-taka-sign mr-1"></i> Unit Price : </strong><span>{{$label->product_unit_price}} BDT</span>
                  <hr>
                  <strong><i class="fa-solid fa-bangladeshi-taka-sign mr-1"></i> Subtotal : </strong><span>{{$label->product_subtotal}} BDT</span>
                  <hr>
                  <strong><i class="fa-solid fa-calendar-days mr-1"></i> Purchase Date : </strong><span id="product_purchase_date">{{$label->purchase_date}}</span>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>

            <div class="col-6">
                <div class="form-group">
                  <label >Product Labeling Type <small style="color: red">*</small></label>
                  <select required class="form-control select2bs4" id="labeling_type" name="labeling_type" style="width: 100%;">                                  
                      <option value="">Select</option>                                        
                      <option value="1">SKU</option>                                                                                              
                      <option value="2">Barcode</option>                                                                                              
                  </select>
                </div>
            </div>

            <div class="col-6">
                <div class="form-group">
                    <label >Tag Number</label>
                    <input type="text" readonly  class="form-control" id="product_tag_number" name="product_tag_number" >
                    <a style="display: none" id="sku_print" target="_blank"  class="btn btn-outline-warning btn-lg float-left" style="margin-right: 5px;">
                        <i class="fas fa-print"></i> Print

                        <div id="sku_details">
                            <div id="skus"></div>
                        </div>
                    </a>
                </div>
            </div>

            <div class="col-6"></div>
            <div class="col-6">
                <div id="barcode_details">
                    <div id="barcodes"></div>
                </div> 
                <a style="display: none" id="barcode_print" target="_blank"  class="btn btn-outline-success btn-lg float-left" style="margin-right: 5px;">
                    <i class="fas fa-print"></i> Print
                </a>
                
            </div>
           
    
          </div><!-- /.row -->
    </div>
</div>
@endsection

@push('masterScripts')
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>

<script>
$(document).ready(function() {
//Initialize Select2 Elements
$('.select2bs4').select2({
      theme: 'bootstrap4'
    })

});


//------barcode print start------  
    $('#barcode_print').on('click', function() {        
        var tagNumber = document.getElementById('product_tag_number').value; 
        var quantity =  document.getElementById('product_quantity').innerHTML;
        generateBarcodes(tagNumber, quantity);

    });


    function generateBarcodes(tagNumber, quantity) {
            var barcodesContainer = document.getElementById('barcodes');
                barcodesContainer.innerHTML = ''; // Clear existing barcodes
                console.log('Generating barcodes: ', quantity);
            for (var i = 0; i < quantity; i++) {
                var svg = document.createElementNS("https://www.w3.org/2000/svg", "svg");
                svg.id = "barcode-" + i;
                barcodesContainer.appendChild(svg);
                console.log('SVG created: ', svg.id);

                // Generate the barcode (using JsBarcode or any other library)
                JsBarcode(svg, tagNumber, {
                    format: "CODE128",
                    displayValue: true
                });
            }
         
            // Wait for the DOM to update with the new SVG elements before printing
            setTimeout(function() {
                for (var i = 0; i < quantity; i++) {
                    var svg = document.getElementById("barcode-" + i);
                    if (svg) {
                        console.log('SVG found: ', svg.id);
                        JsBarcode(svg, tagNumber, {
                            format: "CODE128",
                            displayValue: true
                        });
                        console.log('Barcode generated for: ', svg.id);
                    } else {
                        console.error('SVG not found: barcode-' + i);
                    }
                }

                var printContent = document.getElementById('barcode_details').innerHTML;
                printContentFunction(printContent);
            }, 100); // Adjust the timeout as needed to ensure the DOM is updated

        }

    function printContentFunction(content) {
    var stock_id = $('#stock_id').val();
    var barcode = $('#product_tag_number').val();

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // Store the original content
    var originalContent = document.body.innerHTML;

    // Flag to determine if print dialog was canceled
    var printInProgress = false;

    // Define what happens before and after print
    function beforePrint() {
        console.log('Before print event triggered');
        printInProgress = true;
        // Store barcode data when print dialog is opened
        axios.post('/api/add_barcode/' + stock_id, { barcode: barcode })
            .then(response => {
                console.log('Data stored:', response);
            })
            .catch(error => console.log('Error storing data:', error.response));
    }

    function afterPrint() {
        console.log('After print event triggered');
        // Restore original content after printing
        document.body.innerHTML = originalContent;

        // Use a small delay to check if print was canceled
        setTimeout(function() {
            if (printInProgress) {
                Swal.fire({
                    title: 'Did you complete the print?',
                    text: "Please confirm if you completed the print.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, printed!',
                    cancelButtonText: 'No, canceled'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Print completed');
                        setTimeout(function() {
                                    // window.location.reload(true);
                                    window.location.href = "{{ route('stock_list') }}";
                                }, 2000);
                    } else {
                        console.log('Print dialog was cancelled');
                        // Delete the barcode if print was cancelled
                        axios.post('/api/delete_barcode/' + stock_id)
                            .then(response => {
                                console.log('Data deleted:', response);
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 2000);
                            })
                            .catch(error => Swal.fire({
                                icon: "error",
                                title: error.response.data.message,
                            }));
                    }
                    printInProgress = false; // Reset the flag
                });
            }
        }, 500);
    }

    // Show a confirmation dialog before starting the print
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to print this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, print it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add event listeners for beforeprint and afterprint
            window.addEventListener('beforeprint', beforePrint);
            window.addEventListener('afterprint', afterPrint);

            // Set the body content to the content you want to print
            document.body.innerHTML = content;

            // Call window.print() to print the content
            window.print();

            // Clean up event listeners after printing
            window.removeEventListener('beforeprint', beforePrint);
            window.removeEventListener('afterprint', afterPrint);
        }
    });
}
//------barcode print end-------




//------sku print start------  
$('#sku_print').on('click', function() {    
    var sku = document.getElementById('product_tag_number').value; 
    var quantity =  document.getElementById('product_quantity').innerHTML;
    generateSKUs(sku, quantity);

});


function generateSKUs(sku, quantity) {
            var skusContainer = document.getElementById('skus');
            skusContainer.innerHTML = ''; // Clear existing SKUs

            console.log('Generating SKUs: ', quantity);

            for (var i = 0; i < quantity; i++) {
                var skuElement = document.createElement('div');
                skuElement.textContent = sku;
                skuElement.classList.add('sku');
                skusContainer.appendChild(skuElement);
                console.log('SKU created: ', skuElement.textContent);
            }

            var printContent = document.getElementById('sku_details').innerHTML;
            printSKUContentFunction(printContent);
        }


// function printSKUContentFunction(content){

//     var stock_id = $('#stock_id').val();
//     var skui = $('#product_tag_number').val();
//     // Function to get CSRF token from meta tag
//     function getCsrfToken(){
//         return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
//         }
//     // Set up Axios defaults
//     axios.defaults.withCredentials = true;
//     axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

//     // axios.get('sanctum/csrf-cookie').then(response => {
//     axios.post('/api/add_sku/' + stock_id, {
//         skui: skui
//     }).then(response => {
//         console.log(response);
//     }).catch(error => console.log(error.response));
//     // });



//     var originalContent = document.body.innerHTML;
//     // Set body content to the content you want to print
//     document.body.innerHTML = content;
//     // Call window.print() to print the content
//         window.print();
//     // Restore original content
//     document.body.innerHTML = originalContent;
//     setTimeout(function() {
//         if (!window.matchMedia('print').matches) {
//             // Redirect to a different page if print was canceled
//             window.location.reload(true);
//         }
//     }, 500);
// } 


function printSKUContentFunction(content) {
    var stock_id = $('#stock_id').val();
    var skui = $('#product_tag_number').val();

    // Function to get CSRF token from meta tag
    function getCsrfToken() {
        return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    }

    // Set up Axios defaults
    axios.defaults.withCredentials = true;
    axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

    // Store the original content
    var originalContent = document.body.innerHTML;

    // Flag to determine if print dialog was canceled
    var printInProgress = false;

    // Define what happens before and after print
    function beforePrint() {
        console.log('Before print event triggered');
        printInProgress = true;
        // Store barcode data when print dialog is opened
        axios.post('/api/add_sku/' + stock_id, { skui: skui })
            .then(response => {
                console.log('Data stored:', response);
            })
            .catch(error => console.log('Error storing data:', error.response));
    }

    function afterPrint() {
        console.log('After print event triggered');
        // Restore original content after printing
        document.body.innerHTML = originalContent;

        // Use a small delay to check if print was canceled
        setTimeout(function() {
            if (printInProgress) {
                Swal.fire({
                    title: 'Did you complete the print?',
                    text: "Please confirm if you completed the print.",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, printed!',
                    cancelButtonText: 'No, canceled'
                }).then((result) => {
                    if (result.isConfirmed) {
                        console.log('Print completed');
                        setTimeout(function() {
                                    // window.location.reload(true);
                                    window.location.href = "{{ route('stock_list') }}";
                                }, 2000);
                    } else {
                        console.log('Print dialog was cancelled');
                        // Delete the barcode if print was cancelled
                        axios.post('/api/delete_sku/' + stock_id)
                            .then(response => {
                                console.log('Data deleted:', response);
                                setTimeout(function() {
                                    window.location.reload(true);
                                }, 2000);
                            })
                            .catch(error => Swal.fire({
                                icon: "error",
                                title: error.response.data.message,
                            }));
                    }
                    printInProgress = false; // Reset the flag
                });
            }
        }, 500);
    }

    // Show a confirmation dialog before starting the print
    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to print this document?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, print it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Add event listeners for beforeprint and afterprint
            window.addEventListener('beforeprint', beforePrint);
            window.addEventListener('afterprint', afterPrint);

            // Set the body content to the content you want to print
            document.body.innerHTML = content;

            // Call window.print() to print the content
            window.print();

            // Clean up event listeners after printing
            window.removeEventListener('beforeprint', beforePrint);
            window.removeEventListener('afterprint', afterPrint);
        }
    });
}









//------sku print end-------



$('#labeling_type').on('change',function(){

var labeling_type = $('#labeling_type').val();
var barcode_print = document.getElementById("barcode_print")
var sku_print = document.getElementById("sku_print");
var barcode_show_hide = document.getElementById("barcode_details");

if(labeling_type == 2){

    barcode_show_hide.style.display = "block";

    sku_print.style.display = "none";
    barcode_print.style.display = "block";
    generateProductBarCodeID();
}else{

  barcode_show_hide.style.display = "none";

  sku_print.style.display = "block";
  barcode_print.style.display = "none";
  const productName = $("#product_name").text();
  const productQuantity = $("#product_quantity").text();
  const productPurchaseDate = $("#product_purchase_date").text();
  generateProductSKUID(productName, productQuantity, productPurchaseDate);
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
       generateBarcode(orderID);
  }

  function generateProductSKUID(productName, productQuantity, productPurchaseDate) {
      const now = new Date();
      const year = now.getFullYear();
      const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are zero-indexed
      const day = String(now.getDate()).padStart(2, '0');
      const hours = String(now.getHours()).padStart(2, '0');
      const minutes = String(now.getMinutes()).padStart(2, '0');
      const seconds = String(now.getSeconds()).padStart(2, '0');
      const milliseconds = String(now.getMilliseconds()).padStart(3, '0');
      // Example format: INV-YYYYMMDD-HHMMSS-SSS
      const orderID = `SKU-${productName}-${productQuantity}-${productPurchaseDate}-${year}${month}${day}-${hours}${minutes}${seconds}-${milliseconds}`;
        $("#product_tag_number").val(orderID);    
  }


function generateBarcode(orderID){
            var input = orderID;
            JsBarcode("#barcode", input, {
                format: "CODE128",
                lineColor: "black",
                width: 2,
                height: 40,
                displayValue: false
            });
        }
</script>
  @endpush