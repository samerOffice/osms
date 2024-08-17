@extends('master')

@section('title')
Profiit & Loss Report
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <br>   
        <h1>Profit and Loss Report</h1>
        
        <h2>Revenue</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Sales</td>
                    <td class="text-right">$10,000</td>
                </tr>
                <tr>
                    <td>Other Income</td>
                    <td class="text-right">$1,500</td>
                </tr>
                <tr>
                    <td>Total Due (from Customers)</td>
                    <td class="text-right">$500</td>
                </tr>
                <tr class="total-row">
                    <td>Total Revenue</td>
                    <td class="text-right">$12,000</td>
                </tr>
            </tbody>
        </table>

        <h2>Cost of Goods Sold (COGS)</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Purchases</td>
                    <td class="text-right">$3,000</td>
                </tr>
                <!-- <tr>
                    <td>Direct Labor</td>
                    <td class="text-right">$2,000</td>
                </tr> -->
                <tr class="total-row">
                    <td>Total COGS</td>
                    <td class="text-right">$3,000</td>
                </tr>
                <tr class="total-row">
                    <td>Gross Profit</td>
                    <td class="text-right">$9,000</td>
                </tr>
            </tbody>
        </table>

        <h2>Expenses</h2>
        <table>
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="text-right">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Rent</td>
                    <td class="text-right">$1,200</td>
                </tr>
                <tr>
                    <td>Utilities</td>
                    <td class="text-right">$300</td>
                </tr>
                <tr>
                    <td>Salaries</td>
                    <td class="text-right">$1,500</td>
                </tr>
                <tr class="total-row">
                    <td>Total Expenses</td>
                    <td class="text-right">$3,000</td>
                </tr>
                <tr class="total-row">
                    <td>Net Profit</td>
                    <td class="text-right">$6,000</td>
                </tr>
                <tr class="total-row">
                    <td>Net Loss</td>
                    <td class="text-right">$0</td>
                </tr>
            </tbody>
        </table>
    `   </div>                  
        <br>      
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
  </div>
@endsection