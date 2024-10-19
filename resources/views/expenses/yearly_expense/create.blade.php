@extends('master')

@section('title')
Yearly Expense
@endsection

@section('content')

<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
                    <br> 
                    <div>
                    <div class="row">
                        <div class="col-12">
                            <a class="btn btn-outline-info float-right" href="{{route('yearly_expense_list')}}">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    <div class="col-1"></div>
                    <div class="col-10">
                    <div class="card" style="">
                    <div class="card-header">                                   
                        <h4 class="card-title ">Add New Expense</h4>
                    </div>

                <div class="card-body" >
                {{-- form starts  --}}
                <form id="expenseForm">
                <div class="row" style=" margin: 0 10px; padding: 10px;">                        
                <div class="col-md-12">                          
                    <table class="table table-bordered nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">               
                        <tbody>
                            <div id="form-container">
                                <div class="form-row">
                                    <div class="row" style="width: 100%">

                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="expense_name" class="col-form-label text-start">Expense Name</label>
                                            <input type="text"  class="form-control expense_name" name="expense_name[]">
                                        </div>

                                        <div class="form-group col-md-4 col-sm-4">
                                            <label for="expense_amount"  class="col-form-label text-start">Expense Amount (BDT)</label>
                                            <input type="number" step="0.01" id="initial_expense_amount" onkeyup="initialExpenseAmount()" class="form-control expense_amount" name="expense_amount[]"> 
                                        </div>
                            
                                        <div class="form-group col-md-3 col-sm-4">
                                            <label  class="col-form-label text-start">Payment Date</label>         
                                            <input type="date" id="expense_pay_date" name="expense_pay_date[]" value="{{ date('Y-m-d') }}" class="form-control" />
                                        </div>
                            
                                        <div class="form-group">
                                        <a style="margin-top: 35px; color:white" class="btn btn-info" id="addButton"><i class="fas fa-plus"></i></a>   
                                        </div>

                                    </div> 
                                        {{-- row ends  --}}                                             
                                </div>
                            </div>
                        </tbody>
                    </table>                  
                </div>

                <!-- total amount start -->
                    <div class="form-group col-md-8 col-sm-6"></div>
                    <div class="form-group col-md-3 col-sm-6">
                    <label class="col-form-label">Total Amount (BDT)</label>
                    <input type="text" readonly style="background-color: #e7ffd9" class="form-control" id="totalAmount" name="total_amount">
                    </div>
                    <div class="form-group col-md-1"></div>
                <!-- total amount end -->

                    <div class="col-11"> 
                        <br>     
                        <button type="submit" class="btn btn-primary btn-lg float-right">Submit</button>          
                    </div>
        </div>     
        </form> 
        {{-- form ends  --}}
            </div> <!--end of card body -->
            </div> <!--end of card -->
        </div> <!-- end of col -->
        <div class="col-1"></div>
        </div> <!-- end of row -->         
      </div>
      </div> <!-- /.container-fluid -->     
    </div> <!-- /.content-header -->      
  </div> <!-- /.content-wrapper -->
@endsection

@push('masterScripts')
<script>


function initialExpenseAmount(){
        updateTotal();
    }

document.getElementById('addButton').addEventListener('click', function() { 
        const container = document.getElementById('form-container');
        const newRow = document.createElement('div');
        newRow.className = 'form-row';
        newRow.innerHTML = `<div class="row" style="width: 100%; margin-top: 70px !important;">

                           <div class="form-group col-md-4 col-sm-4">
                                <label for="expense_name" class="col-form-label text-start">Expense Name</label>
                                <input type="text" class="form-control expense_name" name="expense_name[]">
                            </div>

                            <div class="form-group col-md-4 col-sm-4">
                                <label for="expense_amount"  class="col-form-label text-start">Expense Amount (BDT)</label>
                                <input type="number" step="0.01" class="form-control expense_amount" name="expense_amount[]"> 
                            </div>
                            
                            <div class="form-group col-md-3 col-sm-4">
                                <label  class="col-form-label text-start">Payment Date</label>         
                                <input type="date" id="expense_pay_date" name="expense_pay_date[]" value="{{ date('Y-m-d') }}" class="form-control" />
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

    // Attach the change event handler to the new input field
    newRow.querySelector('.expense_amount').addEventListener('input', updateTotal);

});

// Attach event listener to the static initial field
document.querySelector('.expense_amount').addEventListener('input', updateTotal);


function updateTotal() {      
        var total = 0;
        $('.expense_amount').each(function() {
            var subtotal = parseFloat($(this).val());
            if (!isNaN(subtotal)) {
                total += subtotal;
            }
        });

        $('#totalAmount').val(total.toFixed(2));
    }


document.getElementById('expenseForm').addEventListener('submit',function(event){
  event.preventDefault();

var expenseFormData = new FormData(this);

var expense_name = document.getElementsByClassName('expense_name')[0].value;
if (expense_name == '') {
    Swal.fire({
        icon: "warning",
        title: "Please Enter Expense Name",
    });
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
axios.post('/api/submit_yearly_expense',expenseFormData).then(response=>{
  console.log(response);
  setTimeout(function() {
    window.location.href = "{{ route('yearly_expense_list') }}";
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