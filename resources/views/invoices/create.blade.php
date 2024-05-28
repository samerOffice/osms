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
                        <h3 class="card-title">Invoice</h3>
                      </div>
                    <div class="card-body">
                        <form id="invoiceForm" >                                        
                            <div class="card-body">

                              <div class="form-group">
                                <label >Product</label>
                                <select required class="form-control select2bs4" id="product_id" name="product_id" style="width: 100%;">                                  
                                  <option value="">Select Product</option>
                                  @foreach ($products as $product)
                                  <option value="{{$product->id}}">{{$product->product_name}}</option>
                                  @endforeach                                                             
                                </select>
                              </div> 
                              <div class="form-group">
                                <label>date</label>
                                <input type="date" required class="form-control" id="invoice_date" name="invoice_date" >
                              </div> 

                              <div class="form-group">
                                <label >Payment Method</label>
                                <select required class="form-control select2bs4" id="payment_method_id" name="payment_method_id" style="width: 100%;">                                  
                                  <option value="">Select Payment Method</option>
                                  <option value="1">Cash</option>                                                
                                  <option value="2">Card</option>                                                
                                  <option value="3">Bkash</option>                                                
                                </select>
                              </div>
                              
                              <div class="form-group">
                                <label>Sub Total</label>
                                <input type="text" required class="form-control" id="sub_total" name="sub_total" >
                              </div> 

                              <div class="form-group">
                                <label>Discount</label>
                                <input type="text" required class="form-control" id="discount_amount" name="discount_amount" >
                              </div>
                              
                              <div class="form-group">
                                <label style="color: green">Total Amount</label>
                                <input type="text" required class="form-control" id="total_amount" name="total_amount" >
                              </div>
                            </div>
                            <!-- /.card-body -->
                            <button type="submit" class="btn btn-info float-right mr-4">Create Invoice</button>
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

//------------------sub-total and total calculation-----------------
document.addEventListener('DOMContentLoaded', () => {
document.getElementById('sub_total').addEventListener('keyup', (event) => {
    var sub_total = parseFloat(document.getElementById('sub_total').value);
    
    // Ensure sub_total is a valid number, if not set it to 0
    if (isNaN(sub_total)) {
        sub_total = 0;
    }
    var total = sub_total; // Add other values as needed

// Set the total value to the total_amount input
document.getElementById('total_amount').value = total.toFixed(2); // Format to 2 decimal places

    });

//------------------sub-total, total and discount calculation-----------------
    document.getElementById('discount_amount').addEventListener('keyup', (event) => {
    var sub_total = parseFloat(document.getElementById('sub_total').value);
    var discount_amount = parseFloat(document.getElementById('discount_amount').value);
    
    // Ensure discount_amount is a valid number, if not set it to 0
    if (isNaN(discount_amount)) {
        discount_amount = 0;
    }
    var total = sub_total-discount_amount; // Add other values as needed

    // Set the total value to the total_amount input
    document.getElementById('total_amount').value = total.toFixed(2); // Format to 2 decimal places

    });
});



document.getElementById('invoiceForm').addEventListener('submit',function(event){
  event.preventDefault();

var invoiceFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();


axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/submit_invoice',invoiceFormData).then(response=>{
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

