<li class="nav-item nav-link 
            @if(Request::is('accounts_module_active')) nav-link active
            @endif
            " style="@if(Request::is('accounts_module_active')) background-color: #ff774d;
              @endif
              ">
        <a href="{{route('home')}}">
          <i class="nav-icon fas fa-tachometer-alt" style="@if(Request::is('accounts_module_active')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('accounts_module_active')) color:white;
              @endif
              ">
            Dashboard
          </p>
        </a>
      </li>

      <li class="nav-item nav-link 
          @if(Request::is('account_purchase_report')) nav-link active
          @endif
          " style="@if(Request::is('account_purchase_report')) background-color: #ff774d;
            @endif
            ">
      <a href="{{route('account_purchase_report')}}">
        <i class="nav-icon fa-solid fa-file-pen" style="@if(Request::is('account_purchase_report')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('account_purchase_report')) color:white;
            @endif
            ">
          Purchase Report
        </p>
      </a>
    </li>

    <li class="nav-item nav-link 
          @if(Request::is('account_sale_report')) nav-link active
          @endif
          " style="@if(Request::is('account_sale_report')) background-color: #ff774d;
            @endif
            ">
      <a href="{{route('account_sale_report')}}">
        <i class="nav-icon fa-solid fa-file-pen" style="@if(Request::is('account_sale_report')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('account_sale_report')) color:white;
            @endif
            ">
          Sale Report
        </p>
      </a>
    </li>

    <li class="nav-item nav-link 
          @if(Request::is('account_profit_and_loss_report')) nav-link active
          @endif
          " style="@if(Request::is('account_profit_and_loss_report')) background-color: #ff774d;
            @endif
            ">
      <a href="{{route('account_profit_and_loss_report')}}">
        <i class="nav-icon fa-solid fa-file-pen" style="@if(Request::is('account_profit_and_loss_report')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('account_profit_and_loss_report')) color:white;
            @endif
            ">
          Profit and Loss Report
        </p>
      </a>
    </li>

    <li class="nav-item nav-link 
          @if(Request::is('balance_sheet_report')) nav-link active
          @endif
          " style="@if(Request::is('balance_sheet_report')) background-color: #ff774d;
            @endif
            ">
      <a href="{{route('balance_sheet_report')}}">
        <i class="nav-icon fa-solid fa-file-pen" style="@if(Request::is('balance_sheet_report')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('balance_sheet_report')) color:white;
            @endif
            ">
          Balance Sheet
        </p>
      </a>
    </li>

     
   
  