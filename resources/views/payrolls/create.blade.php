@extends('master')

@section('title')
Welcome
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content">
      <div class="container-fluid">

        <div class="row">
          <div class="col-12">
            <br>
            @if ($message = Session::get('success'))
            <div class="alert alert-info" role="alert">
              <div class="row">
                <div class="col-11">
                  {{ $message }}
                </div>
                <div class="col-1">
                  <button type="button" class=" btn btn-info" data-dismiss="alert" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                </div>
              </div>
            </div>
            @endif
        </div>
          <div class="col-12">
            <!-- Main content -->
            <div class=" p-3 mt-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h5>
                    <i class="fa-solid fa-receipt"></i> Pay Slip
                   
                    {{-- <small class="float-right"><b>Joining Date:</b> <span style="color: green" id="member_joining_date"></span></small><br> --}}
                    <small class="float-right"><b>Salary Date:</b> <span style="color: green">{{ \Carbon\Carbon::now()->format('F j, Y') }}</span></small>
                  </h5>
                </div>
              </div>
              <br>
              <!-- info row -->

              <form action="{{route('store_payroll')}}" method="post">
                @csrf
                <div class="row invoice-info">
                  <div class="col-md-4 col-sm-12 invoice-col">
                      <label>Employee Name</label>
                      <select class="form-control select2bs4" id="employee"  name="employee" style="width: 80%;">                                  
                          <option value="">Select Employee</option>
                          @foreach ($members as $member)
                          <option value="{{$member->member_id}}">{{$member->member_name}}</option> 
                          @endforeach                                               
                      </select>
                <br>
                  </div>
                  <div class="col-md-8 col-sm-12 invoice-col">
                    <b>Joining Date:</b> <span id="member_joining_date"></span><br>                                           
                  </div>  
                  
                </div>
                <br>
                <!-- /.row -->
                <div class="row">              
                  <div class="col-12">
                    <h4>Payment Calculation</h4>
                    <input type="hidden" value="{{ \Carbon\Carbon::now()->format('Y-m-d')}} " name="salary_date">
                    <div class="table-responsive">
                      <table class="table">
                        <tr>
                          <td>Joining Date</td>
                          <td><input type="date" readonly id="joining_date" name="joining_date"></td>
                        </tr>
                        <tr>
                          <td>Total Working days</td>
                          <td><input type="number" readonly  id="total_working_day" name="total_working_day" value="26"></td>
                        </tr>
                       
  
                          <tr>
                            <td>Total Leave</td>
                            <td><input type="number" id="total_leave" name="total_leave" value="0" ></td>
                          </tr>
  
                          <tr>
                          <td>Total Number of payable days</td>
                          <td><input type="number" readonly id="total_number_of_pay_day" name="total_number_of_pay_day" value="26"></td>
                        </tr>
                        <tr>
                          <td>Per Day Salary</td>
                          <td><input type="number"  id="per_day_salary" name="per_day_salary"></td>
                        </tr>
                        <tr>
                          <td>Monthly Salary</td>
                          <td><input type="number" readonly id="monthly_salary" name="monthly_salary"></td>
                        </tr>
  
                        <tr>
                          <td>Monthly Holiday Bonus</td>
                          <td><input type="number" readonly  id="monthly_holiday_bonus" name="monthly_holiday_bonus"></td>
                        </tr>
  
                        <tr>
                          <td>Total Daily Allowance</td>
                          <td><input type="number"  id="total_daily_allowance" name="total_daily_allowance"></td>
                        </tr>
                        <tr>
                          <td>Total Travel Allowance</td>
                          <td><input type="number"  id="total_travel_allowance" name="total_travel_allowance"></td>
                        </tr>
                        <tr>
                          <td>Rental Cost Allowance</td>
                          <td><input type="number"  id="rental_cost_allowance" name="rental_cost_allowance"></td>
                        </tr>
                        <tr>
                          <td>Hospital Bill Allowance</td>
                          <td><input type="number"  id="hospital_bill_allowance" name="hospital_bill_allowance"></td>
                        </tr>
  
                        <tr>
                          <td>Insurance Allowance</td>
                          <td><input type="number"  id="insurance_allowance" name="insurance_allowance"></td>
                        </tr>
                        <tr>
                          <td>Sales Commission</td>
                          <td><input type="number"  id="sales_commission" name="sales_commission"></td>
                        </tr>
                        <tr>
                          <td>Retail Commission</td>
                          <td><input type="number"  id="retail_commission" name="retail_commission"></td>
                        </tr>
                        <tr>
                          <th style="color: skyblue">Total Others</th>
                          <td><input type="number" readonly id="total_others" name="total_others"></td>
                        </tr>
                        <tr>
                          <th style="color: green">Total Salary</th>
                          <td><input type="number" readonly  id="total_salary" name="total_salary"></td>
                        </tr>
                        <tr>
                          <td>Yearly Bonus</td>
                          <td><input type="number" id="yearly_bonus" name="yearly_bonus"></td>
                        </tr>
                        <tr>
                          <td>Total Payable Salary</td>
                          <td><input type="number" readonly  id="total_payable_salary" name="total_payable_salary"></td>
                        </tr>
                        <tr>
                          <td>Advance Less</td>
                          <td><input type="number"  id="advance_less" name="advance_less"></td>
                        </tr>
                        <tr>
                          <td>Any Deduction</td>
                          <td><input type="number"  id="any_deduction" name="any_deduction"></td>
                        </tr>
                        <tr>
                          <th>Final Pay Amount</th>
                          <td><input type="number" readonly  id="final_pay_amount" name="final_pay_amount"></td>
                        </tr>
                        {{-- <tr>
                          <th style="color: red">Loan Advance</th>
                          <td><input type="number"  id="loan_advance" name="loan_advance"></td>
                        </tr> --}}
                      </table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <!-- /.row -->
  
                <!-- this row will not appear when printing -->
                <div class="row no-print">
                  <div class="col-12">
                    
                    <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                      Payment
                    </button>
                   
                  </div>
                </div>
              </form>
   
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection


@push('masterScripts')
<script>

$(document).ready(function() {
        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
            });
    });

$('#employee').on('change',function(event){
  event.preventDefault();
  var selectedMember = $('#employee').val();
  $('#total_leave').val('0');
  $('#total_number_of_pay_day').val('');
  $('#monthly_salary').val('');
  $('#yearly_bonus').val('');

   // Function to get CSRF token from meta tag
   function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        }

// Set up Axios defaults
axios.defaults.withCredentials = true;
axios.defaults.headers.common['X-CSRF-TOKEN'] = getCsrfToken();

// axios.get('sanctum/csrf-cookie').then(response=>{
 axios.post('/osms/api/member_details_dependancy',{
        data: selectedMember
      }).then(response=>{

        console.log('my response');

      $('#joining_date').val(response.data.joining_date);

       
      var member_joining_date_from_response = response.data.joining_date;
      var dateParts = member_joining_date_from_response.split("-");
      var jsDate = new Date(dateParts[0], dateParts[1] - 1, dateParts[2]);

      // Format the date using toLocaleDateString with the Bangladeshi locale
      var options = { year: 'numeric', month: 'long', day: 'numeric' };
      var formattedDate = jsDate.toLocaleDateString('en-BD', options);

      // Display the formatted date in the HTML element
      $('#member_joining_date').html(formattedDate);

    //   $('#per_day_salary').val(response.data.per_day_salary);
    //   $('#member_per_day_salary').html(response.data.per_day_salary);
    //   $('#monthly_holiday_bonus').val(response.data.per_day_salary);    
      var total_leave = $('#total_leave').val();

       if(total_leave == '0'){
        $('#total_number_of_pay_day').val('26');
        $('#total_daily_allowance').val(0);
        $('#total_travel_allowance').val(0);
        $('#rental_cost_allowance').val(0);
        $('#hospital_bill_allowance').val(0);
        $('#insurance_allowance').val(0);
        $('#sales_commission').val(0);
        $('#retail_commission').val(0);
        $('#advance_less').val(0);
        $('#any_deduction').val(0);
        $('#per_day_salary').val(0);
        $('#monthly_holiday_bonus').val(0);
        var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
        var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
        var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
        var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
        var insurance_allowance = parseFloat($('#insurance_allowance').val());
        var sales_commission = parseFloat($('#sales_commission').val());
        var retail_commission = parseFloat($('#retail_commission').val());
        var advance_less = parseFloat($('#advance_less').val());
        var any_deduction = parseFloat($('#any_deduction').val());

        var total_number_of_pay_day = parseFloat($('#total_number_of_pay_day').val());
        var per_day_salary = parseFloat($('#per_day_salary').val());
        var monthly_salary = total_number_of_pay_day*per_day_salary;      

        $('#monthly_salary').val(monthly_salary);
        var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());

        //total others result
        var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
        $('#total_others').val(total_others);
        
        //total salary result
        var total_salary = (monthly_salary+total_others);
        $('#total_salary').val(total_salary);


        //total payable salary result
        var yearly_bonus = parseFloat($('#yearly_bonus').val());
        var total_payable_salary = (total_salary+yearly_bonus);
        $('#total_payable_salary').val(total_payable_salary);

        //final pay amount result
        var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
        $('#final_pay_amount').val(final_pay_amount);     
        
       }    

      });
//  });
});



//total leave calculation
$('#total_leave').on('keyup', function(){
    var total_working_day = parseFloat($('#total_working_day').val());
    var total_leave = parseFloat($('#total_leave').val());
    var per_day_salary = parseFloat($('#per_day_salary').val());
      
    var total_number_of_pay_day = total_working_day-total_leave;
    var monthly_salary = total_number_of_pay_day*per_day_salary;

    $('#total_number_of_pay_day').val(total_number_of_pay_day);
    $('#monthly_salary').val(monthly_salary);
    $('#monthly_holiday_bonus').val(per_day_salary);


    $('#total_daily_allowance').val(0);
    $('#total_travel_allowance').val(0);
    $('#rental_cost_allowance').val(0);
    $('#hospital_bill_allowance').val(0);
    $('#insurance_allowance').val(0);
    $('#sales_commission').val(0);
    $('#retail_commission').val(0);
    $('#advance_less').val(0);
    $('#any_deduction').val(0);
    $('#yearly_bonus').val(0);
    var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
    var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
    var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
    var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
    var insurance_allowance = parseFloat($('#insurance_allowance').val());
    var sales_commission = parseFloat($('#sales_commission').val());
    var retail_commission = parseFloat($('#retail_commission').val());
    var monthly_salary = parseFloat($('#monthly_salary').val());
    var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
    var advance_less = parseFloat($('#advance_less').val());
    var any_deduction = parseFloat($('#any_deduction').val());

    //total others result
    var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
    $('#total_others').val(total_others);
    
    //total salary result
    var total_salary = (monthly_salary+total_others);
    $('#total_salary').val(total_salary);

    //total payable salary result
    var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
        $('#final_pay_amount').val(final_pay_amount);

    });


 //per day salary
$('#per_day_salary').on('keyup', function(){
    var total_working_day = parseFloat($('#total_working_day').val());
    var total_leave = parseFloat($('#total_leave').val());
    var per_day_salary = parseFloat($('#per_day_salary').val());
      
    var total_number_of_pay_day = total_working_day-total_leave;
    var monthly_salary = total_number_of_pay_day*per_day_salary;

    $('#total_number_of_pay_day').val(total_number_of_pay_day);
    $('#monthly_salary').val(monthly_salary);
    $('#monthly_holiday_bonus').val(per_day_salary);

    $('#total_daily_allowance').val(0);
    $('#total_travel_allowance').val(0);
    $('#rental_cost_allowance').val(0);
    $('#hospital_bill_allowance').val(0);
    $('#insurance_allowance').val(0);
    $('#sales_commission').val(0);
    $('#retail_commission').val(0);
    $('#advance_less').val(0);
    $('#any_deduction').val(0);
    $('#yearly_bonus').val(0);
    var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
    var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
    var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
    var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
    var insurance_allowance = parseFloat($('#insurance_allowance').val());
    var sales_commission = parseFloat($('#sales_commission').val());
    var retail_commission = parseFloat($('#retail_commission').val());
    var monthly_salary = parseFloat($('#monthly_salary').val());
    var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
    var advance_less = parseFloat($('#advance_less').val());
    var any_deduction = parseFloat($('#any_deduction').val());

    //total others result
    var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
    $('#total_others').val(total_others);
    
    //total salary result
    var total_salary = (monthly_salary+total_others);
    $('#total_salary').val(total_salary);

    //total payable salary result
    var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
        $('#final_pay_amount').val(final_pay_amount);

    });


//total daily allowannce calculation
$('#total_daily_allowance').on('keyup',function(){
  $('#total_travel_allowance').val(0);
  $('#rental_cost_allowance').val(0);
  $('#hospital_bill_allowance').val(0);
  $('#insurance_allowance').val(0);
  $('#sales_commission').val(0);
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   
   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});


//total travel allowannce calculation
$('#total_travel_allowance').on('keyup',function(){
  $('#rental_cost_allowance').val(0);
  $('#hospital_bill_allowance').val(0);
  $('#insurance_allowance').val(0);
  $('#sales_commission').val(0);
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
      $('#final_pay_amount').val(final_pay_amount);
});


//rental allowance calculation
$('#rental_cost_allowance').on('keyup',function(){
  $('#hospital_bill_allowance').val(0);
  $('#insurance_allowance').val(0);
  $('#sales_commission').val(0);
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);
});

//hospital bill allowance calculation
$('#hospital_bill_allowance').on('keyup',function(){
  $('#insurance_allowance').val(0);
  $('#sales_commission').val(0);
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});


//insurance allowance calculation
$('#insurance_allowance').on('keyup',function(){
  $('#sales_commission').val(0);
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

   //final pay amount result
   var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
   $('#final_pay_amount').val(final_pay_amount);
});


//sales commission calculation
$('#sales_commission').on('keyup',function(){
  $('#retail_commission').val(0);
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});


//retail commission calculation
$('#retail_commission').on('keyup',function(){
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});


//Extra (yearly) Bonus calculation
$('#yearly_bonus').on('keyup',function(){
  $('#advance_less').val(0);
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});



//advance less calculation
$('#advance_less').on('keyup',function(){
  $('#any_deduction').val(0);
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});


//any deduction calculation
$('#any_deduction').on('keyup',function(){
  var total_daily_allowance = parseFloat($('#total_daily_allowance').val());
  var total_travel_allowance = parseFloat($('#total_travel_allowance').val());
  var rental_cost_allowance = parseFloat($('#rental_cost_allowance').val());
  var hospital_bill_allowance = parseFloat($('#hospital_bill_allowance').val());
  var insurance_allowance = parseFloat($('#insurance_allowance').val());
  var sales_commission = parseFloat($('#sales_commission').val());
  var retail_commission = parseFloat($('#retail_commission').val());
  var monthly_salary = parseFloat($('#monthly_salary').val());
  var monthly_holiday_bonus = parseFloat($('#monthly_holiday_bonus').val());
  var advance_less = parseFloat($('#advance_less').val());
  var any_deduction = parseFloat($('#any_deduction').val());

  //total others result
  var total_others = (monthly_holiday_bonus+total_daily_allowance+total_travel_allowance+rental_cost_allowance+hospital_bill_allowance+insurance_allowance+sales_commission+retail_commission);
  $('#total_others').val(total_others);
  
  //total salary result
  var total_salary = (monthly_salary+total_others);
   $('#total_salary').val(total_salary);

   //total payable salary result
   var yearly_bonus = parseFloat($('#yearly_bonus').val());
    var total_payable_salary = (total_salary+yearly_bonus);
    $('#total_payable_salary').val(total_payable_salary);

    //final pay amount result
    var final_pay_amount = (total_payable_salary-(advance_less+any_deduction));
    $('#final_pay_amount').val(final_pay_amount);
});

  </script>
  @endpush