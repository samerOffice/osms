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

    <li class="nav-item @if(Request::is('daily_expense_report')) menu-open 
          @elseif(Request::is('monthly_expense_report')) menu-open 
          @elseif(Request::is('yearly_expense_report')) menu-open 
        @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-file-pen"></i>
        <p>
          Expense Report
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('daily_expense_report')}}" class="nav-link {{ Request::is('daily_expense_report') ? 'nav-link active' : ''}}" style="{{ Request::is('daily_expense_report') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('daily_expense_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('daily_expense_report') ? 'color: white; !important' : ''}}">Daily Expense</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('monthly_expense_report')}}" class="nav-link {{ Request::is('monthly_expense_report') ? 'nav-link active' : ''}}" style="{{ Request::is('monthly_expense_report') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('monthly_expense_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('monthly_expense_report') ? 'color: white; !important' : ''}}">Monthly Expense</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('yearly_expense_report')}}" class="nav-link {{ Request::is('yearly_expense_report') ? 'nav-link active' : ''}}" style="{{ Request::is('yearly_expense_report') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('yearly_expense_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('yearly_expense_report') ? 'color: white; !important' : ''}}">Yearly Expense</p>
          </a>
        </li>

      </ul>
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

   

    <li class="nav-item @if(Request::is('add_balance_transaction')) menu-open 
         @elseif(Request::is('balance_transaction_list')) menu-open 
         @elseif(Request::is('balance_sheet_report')) menu-open 
        @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-calculator"></i>
        <p>
          Accounts
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('add_balance_transaction')}}" class="nav-link {{ Request::is('add_balance_transaction') ? 'nav-link active' : ''}}" style="{{ Request::is('add_balance_transaction') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('add_balance_transaction') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('add_balance_transaction') ? 'color: white; !important' : ''}}">Add Transaction</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('balance_transaction_list')}}" class="nav-link {{ Request::is('balance_transaction_list') ? 'nav-link active' : ''}}" style="{{ Request::is('balance_transaction_list') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('balance_transaction_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('balance_transaction_list') ? 'color: white; !important' : ''}}">Transactions</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('balance_sheet_report')}}" class="nav-link {{ Request::is('balance_sheet_report') ? 'nav-link active' : ''}}" style="{{ Request::is('balance_sheet_report') ? 'background-color: #ff774d; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('balance_sheet_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('balance_sheet_report') ? 'color: white; !important' : ''}}">Balance Sheet Report</p>
          </a>
        </li>

      </ul>
      </li>


     
   
  