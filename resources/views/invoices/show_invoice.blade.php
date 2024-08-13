@extends('master')

@section('title')
Invoice
@endsection


@section('content')
<body>
   <div class="content-wrapper">
        <div class="container-fluid">
        <div class="invoice-box">
        <table>
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <h1>{{$invoice_data->shop_name}}</h1>
                            </td>
                            <td>
                                <span style = "color: blue">{{$invoice_data->invoice_order_number}}</span><br>
                                Created: {{ \Carbon\Carbon::now()->format('F j, Y') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                             <h5>Outlet</h5>
                            {{$invoice_data->shop_outlet_name}}<br>
                            {{$invoice_data->shop_outlet_address}}<br>
                            <br>
                            <h5>Shop</h5>
                            {{$invoice_data->shop_name}}<br>
                            {{$invoice_data->shop_address}}<br>
                            {{$invoice_data->shop_contact_no}}<br>
                            </td>
                            <td>
                            <h5>Cashier</h5>
                            {{$invoice_data->sale_by}}<br>
                           
                            <br>
                            @if($invoice_data->buyer_name != '')
                            <h5>Customer</h5>
                            {{$invoice_data->buyer_name}}<br>
                            Membership No. : {{$invoice_data->membership_number}}<br>
                                Phone: {{$invoice_data->buyer_number}}
                            @endif
                            </td>

                            
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="heading">
                <td colspan="4">Payment Method</td>
                
            </tr>
            <tr class="details">
                <td colspan="4">
                    @if($invoice_data->payment_method == 1)
                    Cash
                    @else
                    Others
                    @endif
                </td>
                
            </tr>
            <tr class="heading">
                <td>Items</td>
                <td>Quantity</td>
                <td>Unit Price</td>
                <td>Sub Total</td>
            </tr>
            @foreach($item_data as $item)
            <tr class="item">
                <td>{{$item->sold_product_name}}</td>
                <td>{{$item->quantity}}</td>
                <td>{{$item->unit_price}} BDT</td>
                <td>{{$item->sub_total}} BDT</td>
            </tr>
           @endforeach
            <!-- <tr class="total">
                <td></td>
                <td>Total: $600.00</td>
            </tr> -->
        </table>
        <br>
        <p align="right" class="" style="padding-right: 80px;"><b>Total: {{$invoice_data->invoice_total_amount}} BDT</b></p>
        @if($invoice_data->invoice_tax_amount != '')
        <p align="right" class="" style="padding-right: 80px;"><b>Tax: {{number_format($invoice_data->invoice_tax_amount, 2)}} BDT</b></p>
        @endif
        @if($invoice_data->invoice_discount_amount != '')
        <p align="right" class="" style="padding-right: 80px;"><b>Discount: {{number_format($invoice_data->invoice_discount_amount, 2)}} BDT</b></p>
        @endif
        <p align="right" class="" style="padding-right: 80px;"><b>Grand Total: {{$invoice_data->invoice_grand_total}} BDT</b></p>
        @if(($invoice_data->invoice_due_amount == '') || ($invoice_data->invoice_due_amount == 0))
        <p align="right" class="" style="padding-right: 80px; color: red"><b>Due: 0.00 BDT</b></p>
        @else
        <p align="right" class="" style="padding-right: 80px; color: red"><b>Due: {{number_format($invoice_data->invoice_due_amount, 2)}} BDT</b></p>
        @endif
        <p align="right" class="" style="padding-right: 80px; color:green"><b>Paid: {{number_format($invoice_data->invoice_paid_amount, 2)}} BDT</b></p>
        <br>
        <h3>Terms and Conditions</h3>
        <p>All sales are final. Please make the payment within 7 days. Late payments will incur a 5% penalty.</p>

        <!-- Print Button -->
        <div class="print-button">
            <button onclick="window.print()">Print Invoice</button>
        </div>
    </div>
        </div>
    </div>
    </body>
@endsection




