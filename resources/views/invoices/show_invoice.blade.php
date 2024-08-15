@extends('master')

@section('title')
Invoice
@endsection

@section('content')
<body>
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="invoice-box">
                <!-- Start of the part you want to print -->
                <div id="print-section" class="a4-print">
                    <table>
                        <tr class="top">
                            <td colspan="4">
                                <table>
                                    <tr>
                                        <td class="title">
                                            <h1>{{$invoice_data->shop_name}}</h1>
                                        </td>
                                        <td>
                                            <span style="color: blue">{{$invoice_data->invoice_order_number}}</span><br>
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
                                            Membership No.: {{$invoice_data->membership_number}}<br>
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
                    </table>
                    <br>
                    <div class="totalamountborder">
                        <div class="totalammount">
                            <p><b>Total: {{$invoice_data->invoice_total_amount}} BDT</b></p>
                            @if($invoice_data->invoice_tax_amount != '')
                            <p><b>Tax: {{number_format($invoice_data->invoice_tax_amount, 2)}} BDT</b></p>
                            @endif
                            @if($invoice_data->invoice_discount_amount != '')
                            <p><b>Discount: {{number_format($invoice_data->invoice_discount_amount, 2)}} BDT</b></p>
                            @endif
                            <p><b>Grand Total: {{$invoice_data->invoice_grand_total}} BDT</b></p>
                            @if(($invoice_data->invoice_due_amount == '') || ($invoice_data->invoice_due_amount == 0))
                            <p style="color: red"><b>Due: 0.00 BDT</b></p>
                            @else
                            <p style="color: red"><b>Due: {{number_format($invoice_data->invoice_due_amount, 2)}} BDT</b></p>
                            @endif
                            <p style="color:green"><b>Paid: {{number_format($invoice_data->invoice_paid_amount, 2)}} BDT</b></p>
                        </div>
                    </div>
                    <br>
                    <h3>Terms and Conditions</h3>
                    <p>All sales are final. Please make the payment within 7 days. Late payments will incur a 5% penalty.</p>
                </div>
                <!-- End of the part you want to print -->
                <!-- Print Button -->
                <div class="print-button">
                    <button onclick="printInvoice('a4')">Print Invoice In A4</button>
                    <button onclick="printInvoice('half-a4')">Print Invoice In Half A4</button>
                    <button onclick="printInvoice('pos')">Print Invoice In POS Machine</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* General print styles */
        @media print {
            body * {
                visibility: hidden;
            }
            #print-section, #print-section * {
                visibility: visible;
            }
            #print-section {
                position: absolute;
                top: 0;
                left: 0;
            }
        }

        /* A4 Print Styles */
        .a4-print {
            width: 100%; /* A4 width */
            height: 297mm; /* A4 height */
            padding: 10mm;
            margin: 0;
            font-size: 12pt;
            page-break-after: always; /* Ensure content starts on a new page */
        }

        .a4-print h1, .a4-print h5, .a4-print p {
            margin: 2px 0;
        }

        .a4-print table {
            width: 100%;
            border-collapse: collapse;
            margin: 5px 0;
        }

        .a4-print table, .a4-print th, .a4-print td {
            border: 1px solid black;
            border-bottom: 2px solid #000000;
            padding: 0px;
            text-align: left;
        }

        .a4-print th {
            background-color: #f2f2f2;
        }

        /* Half A4 Print Styles */
        .half-a4-print {
            width: 200%; /* Full width of A4 */
            height: 178.5mm; /* Half of A4 height */
            padding: 10mm;
            margin: 0;
            font-size: 23pt; /* Adjust font size for half A4 */
            box-sizing: border-box; /* Ensure padding is included in the height */
            transform: scale(0.5); /* Scales down content to fit half the page */
            transform-origin: top left;
            page-break-after: always; /* Ensure content starts on a new page */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .half-a4-print h1{
            font-size: 26pt;
            font-weight: bold;
            color: #0b6c3b;
        }

        .half-a4-print h5{
            font-size: 23pt;
        }

        /* POS Print Styles */
        .pos-print {
            width: 80mm;
            height: auto; /* Adjust height to fit content */
            padding: 3mm;
            font-size: 10pt; /* Smaller font for POS */
        }

        /* Aligning total amount section to the right */
        .totalammount {
            text-align: right;
            padding-right: 0px;
            padding: 10px;
        }

        .totalamountborder {
            border-style: ridge;
        }

        /* Print Button Styles */
        .print-button {
            margin-top: 20px;
        }

        .print-button button {
            margin: 0 5px;
            padding: 10px 20px;
            font-size: 14px;
            cursor: pointer;
        }
    </style>

    <script>
        function printInvoice(size) {
            const printSection = document.getElementById('print-section');

            if (size === 'a4') {
                printSection.classList.remove('pos-print');
                printSection.classList.remove('half-a4-print');
                printSection.classList.add('a4-print');
            } else if (size === 'half-a4') {
                printSection.classList.remove('a4-print');
                printSection.classList.remove('pos-print');
                printSection.classList.add('half-a4-print');
            } else if (size === 'pos') {
                printSection.classList.remove('a4-print');
                printSection.classList.remove('half-a4-print');
                printSection.classList.add('pos-print');
            }
            window.print();
        }
    </script>
</body>
@endsection
