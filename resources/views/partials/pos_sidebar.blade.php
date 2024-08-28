<li class="nav-item nav-link 
            @if(Request::is('pos_module_active')) nav-link active
            @endif
            " style="@if(Request::is('pos_module_active')) background-color: #20ceea;
              @endif
              ">
        <a href="{{route('home')}}">
          <i class="nav-icon fas fa-tachometer-alt" style="@if(Request::is('pos_module_active')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('pos_module_active')) color:white;
              @endif
              ">
            Dashboard
          </p>
        </a>
      </li>

      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(17, $permitted_menus_array)))
      <li class="nav-item nav-link 
            @if(Request::is('add_invoice')) nav-link active
            @endif
            " style="@if(Request::is('add_invoice')) background-color: #20ceea;
              @endif
              ">
        <a href="{{route('add_invoice')}}">
          <i class="nav-icon fa-solid fa-receipt" style="@if(Request::is('add_invoice')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('add_invoice')) color:white;
              @endif
              ">
            Sale & Invoice
          </p>
        </a>
      </li>
      @endif


      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(18, $permitted_menus_array)))
      <li class="nav-item nav-link 
          @if(Request::is('sale_list')) nav-link active
          @endif
          " style="@if(Request::is('sale_list')) background-color: #20ceea;
            @endif
            ">
      <a href="{{route('sale_list')}}">
        <i class="nav-icon fa-solid fa-list" style="@if(Request::is('sale_list')) color: white;
            @endif
            ">
        </i>
        <p style="@if(Request::is('sale_list')) color:white;
            @endif
            ">
          Sales List
        </p>
      </a>
    </li>
    @endif


    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(19, $permitted_menus_array)))
      <li class="nav-item nav-link 
            @if(Request::is('customer_list')) nav-link active
            @endif
            " style="@if(Request::is('customer_list')) background-color: #20ceea;
              @endif
              ">
        <a href="{{route('customer_list')}}">
          <i class="nav-icon fa-solid fa-users" style="@if(Request::is('customer_list')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('customer_list')) color:white;
              @endif
              ">
            Customers
          </p>
        </a>
      </li>
    @endif


    @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(20, $permitted_menus_array)))
      <li class="nav-item nav-link 
            @if(Request::is('customer_due_list')) nav-link active
            @endif
            " style="@if(Request::is('customer_due_list')) background-color: #20ceea;
              @endif
              ">
        <a href="{{route('customer_due_list')}}">
          <i class="nav-icon fa-regular fa-clipboard" style="@if(Request::is('customer_due_list')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('customer_due_list')) color:white;
              @endif
              ">
            Customer Due List
          </p>
        </a>
      </li>
      @endif

      {{-- <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-gem"></i>
          <p> Offers</p>
        </a>
      </li> --}}

      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(21, $permitted_menus_array)))
        <li class="nav-item nav-link 
            @if(Request::is('terms_and_conditions')) nav-link active
            @endif
            " style="@if(Request::is('terms_and_conditions')) background-color: #20ceea;
              @endif
              ">
        <a href="{{route('terms_and_conditions')}}">
          <i class="nav-icon fa-solid fa-list" style="@if(Request::is('terms_and_conditions')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('terms_and_conditions')) color:white;
              @endif
              ">
            Terms & Conditions
          </p>
        </a>
      </li>
      @endif


        <li class="nav-item @if(Request::is('profit_and_loss_report')) menu-open 
             @elseif(Request::is('sale_report')) menu-open
            @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-layer-group"></i>
          <p>
            Reports
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('profit_and_loss_report')}}" class="nav-link {{ Request::is('profit_and_loss_report') ? 'nav-link active' : ''}}" style="{{ Request::is('profit_and_loss_report') ? 'background-color: #20ceea; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}">Profit & Loss Report</p>
            </a>
          </li>

          {{-- <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('profit_and_loss_report')}}" class="nav-link {{ Request::is('profit_and_loss_report') ? 'nav-link active' : ''}}" style="{{ Request::is('profit_and_loss_report') ? 'background-color: #20ceea; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}">Customer Due Report</p>
            </a>
          </li> --}}

          {{-- <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('profit_and_loss_report')}}" class="nav-link {{ Request::is('profit_and_loss_report') ? 'nav-link active' : ''}}" style="{{ Request::is('profit_and_loss_report') ? 'background-color: #20ceea; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('profit_and_loss_report') ? 'color: white; !important' : ''}}">Expense Report</p>
            </a>
          </li> --}}

          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('sale_report')}}" class="nav-link {{ Request::is('sale_report') ? 'nav-link active' : ''}}" style="{{ Request::is('sale_report') ? 'background-color: #20ceea; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('sale_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('sale_report') ? 'color: white; !important' : ''}}">Sales Report</p>
            </a>
          </li>

        </ul>
      </li>