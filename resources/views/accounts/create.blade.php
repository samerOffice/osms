@extends('master')

@section('title')
Rent
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>
        <div class="row">
          <div class="col-12">
            <a class="btn btn-outline-info float-right" href="{{route('balance_transaction_list')}}">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
               
            <div class="col-12">
                <br>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Add Transaction</h3>
                      </div>
                    <div class="card-body">
                        <form id="transactionForm" >                                        
                            <div class="card-body">
                              {{-- <div class="form-group">
                                <label>Rent Eligible month : </label> <br>
                                <h5 id="rent_eligible_date" style="color: blue">{{ \Carbon\Carbon::now()->subMonth()->format('F Y') }}</h5>
                              </div>  --}}

                              <div class="form-group">
                                <label>Transaction Date</label>
                                <input type="date"  class="form-control" id="transaction_date" name="transaction_date" required>
                              </div>

                              <div class="form-group">
                                <label>Transaction Name</label>
                                <input type="text"  class="form-control" id="transaction_name" name="transaction_name" required>
                              </div>

                              <div class="form-group">
                                <label>Transaction Type</label>
                                <select class="form-control select2bs4" required id="transaction_type" name="transaction_type" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option value="1">Debit</option>
                                    <option value="2">Credit</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Cost Type</label>
                                <select class="form-control select2bs4" required id="cost_type" name="cost_type" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option value="A">Asset</option>
                                    <option value="L">Liability</option>
                                    <option value="E">Equity</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label>Cost Less</label>
                                <select class="form-control select2bs4" required id="cost_less" name="cost_less" style="width: 100%;">
                                    <option value="">Select</option>
                                    <option value="1">Yes</option>
                                    <option value="2">No</option>
                                </select>
                              </div>                            

                              <div class="form-group">
                                <label>Amount (BDT)</label>
                                <input type="number"  class="form-control" id="transaction_amount" step="0.01" name="transaction_amount" required>
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


document.getElementById('transactionForm').addEventListener('submit',function(event){
  event.preventDefault();

var transactionFormData = new FormData(this);
// const submitBtn = document.getElementById('submitBtn');

// Function to get CSRF token from meta tag
function getCsrfToken() {
  return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  }
// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/api/submit_balance_transaction',transactionFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
    window.location.reload();
    window.location.href = "{{ route('balance_transaction_list') }}";
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

</script>
@endpush

