<aside class="main-sidebar sidebar-dark-info elevation-4">
  @if($current_module->module_status == 1) <!--general module-->
  <!-- Brand Logo -->
  <a href="{{route('home')}}"><img src="{{asset('img/dashboardlogo.gif')}}" width="100%" alt="logo"></a>
  @endif


  <!-- Sidebar -->
  <div class="sidebar" style="margin-top:10px;">
    

    <!-- SidebarSearch Form -->
    <div class="form-inline" style="">
      <div class="input-group" data-widget="sidebar-search">
        <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-sidebar">
            <i class="fas fa-search fa-fw"></i>
          </button>
        </div>
      </div>
    </div>

    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">
          <font color="#fff">Welcome</font> {{ Auth::user()->name }}&nbsp;!
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        @if($current_module->module_status == 1) <!--general module-->
        <li class="nav-item nav-link {{ Request::is('dashboard') ? 'nav-link active' : ''}}" style="{{ Request::is('dashboard') ? 'background-color: #908ec4; !important' : ''}}">
          <a href="{{route('home')}}">
            <i class="nav-icon fas fa-tachometer-alt" style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('dashboard') ? 'color: white; !important' : ''}}">
              Dashboard
            </p>
          </a>
        </li>


        @if((auth()->user()->role_id == 1))
        <li class="nav-item nav-link @if(Request::is('shop_list')) nav-link active @endif" style="@if(Request::is('shop_list')) background-color: #908ec4; @endif">
          <a href="{{route('shop_list')}}">
            <i class="nav-icon fa-solid fa-list" style=" @if(Request::is('shop_list')) color: white; @endif"></i>
            <p style="@if(Request::is('shop_list')) color:white; @endif"> Shop List</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('shop_details')) nav-link active @endif" style="@if(Request::is('shop_details')) background-color: #908ec4; @endif">
          <a href="{{route('shop_details')}}">
            <i class="nav-icon fa-solid fa-shop" style=" @if(Request::is('shop_details')) color: white; @endif"></i>
            <p style="@if(Request::is('shop_details')) color:white; @endif"> Shop Details</p>
          </a>
        </li>

        @elseif((auth()->user()->role_id == 2))
        <li class="nav-item nav-link @if(Request::is('shop_details')) nav-link active @endif" style="@if(Request::is('shop_details')) background-color: #908ec4; @endif">
          <a href="{{route('shop_details')}}">
            <i class="nav-icon fa-solid fa-shop" style=" @if(Request::is('shop_details')) color: white; @endif"></i>
            <p style="@if(Request::is('shop_details')) color:white; @endif"> Shop</p>
          </a>
        </li>
        @else
        @endif

        <li class="nav-item">
          <a href="{{route('designation_list')}}" class="nav-link {{ Request::is('designation_list') ? 'nav-link active' : ''}}" style="{{ Request::is('designation_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="fa-solid fa-address-card nav-icon" style="{{ Request::is('designation_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('designation_list') ? 'color: white; !important' : ''}}">Designation</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('branch_list')) nav-link active @endif" style="@if(Request::is('branch_list')) background-color: #908ec4; @endif">
          <a href="{{route('branch_list')}}">
            <i class="nav-icon fa-solid fa-building" style=" @if(Request::is('branch_list')) color: white; @endif"></i>
            <p style="@if(Request::is('branch_list')) color:white; @endif"> Branch</p>
          </a>
        </li>

        {{-- <li class="nav-item nav-link @if(Request::is('asset_list')) nav-link active @endif" style="@if(Request::is('asset_list')) background-color: #908ec4; @endif">
          <a href="{{route('asset_list')}}">
            <i class="nav-icon fa-solid fa-laptop" style=" @if(Request::is('asset_list')) color: white; @endif"></i>
            <p style="@if(Request::is('asset_list')) color:white; @endif"> Asset</p>
          </a>
        </li> --}}


        <li class="nav-item nav-link @if(Request::is('outlet_list')) nav-link active @endif" style="@if(Request::is('outlet_list')) background-color: #908ec4; @endif">
          <a href="{{route('outlet_list')}}">
            <i class="nav-icon fa-solid fa-store" style=" @if(Request::is('outlet_list')) color: white; @endif"></i>
            <p style="@if(Request::is('outlet_list')) color:white; @endif"> Outlet</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('warehouse_list')) nav-link active @endif" style="@if(Request::is('warehouse_list')) background-color: #908ec4; @endif">
          <a href="{{route('warehouse_list')}}">
            <i class="nav-icon fa-solid fa-warehouse" style=" @if(Request::is('warehouse_list')) color: white; @endif"></i>
            <p style="@if(Request::is('warehouse_list')) color:white; @endif">Warehouse</p>
          </a>
        </li>


        <li class="nav-item nav-link @if(Request::is('department_list')) nav-link active @endif" style="@if(Request::is('department_list')) background-color: #908ec4; @endif">
          <a href="{{route('department_list')}}">
            <i class="nav-icon fa-solid fa-hotel" style=" @if(Request::is('department_list')) color: white; @endif"></i>
            <p style="@if(Request::is('department_list')) color:white; @endif"> Department</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('supplier_list')) nav-link active @endif" style="@if(Request::is('supplier_list')) background-color: #908ec4; @endif">
          <a href="{{route('supplier_list')}}">
            <i class="nav-icon fa-solid fa-users" style=" @if(Request::is('supplier_list')) color: white; @endif"></i>
            <p style="@if(Request::is('supplier_list')) color:white; @endif"> Supplier</p>
          </a>
        </li>

        <li class="nav-item nav-link @if(Request::is('supplier_due_list')) nav-link active @endif" style="@if(Request::is('supplier_due_list')) background-color: #908ec4; @endif">
          <a href="{{route('supplier_due_list')}}">
            <i class="nav-icon fa-regular fa-clipboard" style=" @if(Request::is('supplier_due_list')) color: white; @endif"></i>
            <p style="@if(Request::is('supplier_due_list')) color:white; @endif"> Supplier Due List</p>
          </a>
        </li>

        
        <li class="nav-item @if(Request::is('rent_list')) menu-open 
         @elseif(Request::is('utility_list')) menu-open 
         @elseif(Request::is('daily_expense_list')) menu-open 
         @elseif(Request::is('monthly_expense_list')) menu-open 
         @elseif(Request::is('yearly_expense_list')) menu-open 
        @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-receipt"></i>
        <p>
          Expenses
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('rent_list')}}" class="nav-link {{ Request::is('rent_list') ? 'nav-link active' : ''}}" style="{{ Request::is('rent_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('rent_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('rent_list') ? 'color: white; !important' : ''}}">Rents</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('utility_list')}}" class="nav-link {{ Request::is('utility_list') ? 'nav-link active' : ''}}" style="{{ Request::is('utility_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('utility_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('utility_list') ? 'color: white; !important' : ''}}">Utilities</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('daily_expense_list')}}" class="nav-link {{ Request::is('daily_expense_list') ? 'nav-link active' : ''}}" style="{{ Request::is('daily_expense_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('daily_expense_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('daily_expense_list') ? 'color: white; !important' : ''}}">Daily Expense</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('monthly_expense_list')}}" class="nav-link {{ Request::is('monthly_expense_list') ? 'nav-link active' : ''}}" style="{{ Request::is('monthly_expense_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('monthly_expense_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('monthly_expense_list') ? 'color: white; !important' : ''}}">Monthly Expense</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('yearly_expense_list')}}" class="nav-link {{ Request::is('yearly_expense_list') ? 'nav-link active' : ''}}" style="{{ Request::is('yearly_expense_list') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('yearly_expense_list') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('yearly_expense_list') ? 'color: white; !important' : ''}}">Yearly Expense</p>
          </a>
        </li>

      </ul>
      </li>


    {{-- <li class="nav-item @if(Request::is('account_purchase_report')) menu-open 
         @elseif(Request::is('account_sale_report')) menu-open 
         @elseif(Request::is('account_profit_and_loss_report')) menu-open 
        @endif">
      <a href="#" class="nav-link">
        <i class="nav-icon fa-solid fa-file-invoice"></i>
        <p>
          Accounts
          <i class="fas fa-angle-left right"></i>
        </p>
      </a>
      <ul class="nav nav-treeview">
        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('account_purchase_report')}}" class="nav-link {{ Request::is('account_purchase_report') ? 'nav-link active' : ''}}" style="{{ Request::is('account_purchase_report') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('account_purchase_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('account_purchase_report') ? 'color: white; !important' : ''}}">Purchase Report</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('account_sale_report')}}" class="nav-link {{ Request::is('account_sale_report') ? 'nav-link active' : ''}}" style="{{ Request::is('account_sale_report') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('account_sale_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('account_sale_report') ? 'color: white; !important' : ''}}">Sale Report</p>
          </a>
        </li>

        <li class="nav-item" style="padding-left : 15px">
          <a href="{{route('account_profit_and_loss_report')}}" class="nav-link {{ Request::is('account_profit_and_loss_report') ? 'nav-link active' : ''}}" style="{{ Request::is('account_profit_and_loss_report') ? 'background-color: #908ec4; !important' : ''}}">
            <i class="far fa-circle nav-icon" style="{{ Request::is('account_profit_and_loss_report') ? 'color: white; !important' : ''}}"></i>
            <p style="{{ Request::is('account_profit_and_loss_report') ? 'color: white; !important' : ''}}">Profit and Loss Report</p>
          </a>
        </li>

      </ul>
    </li> --}}

    

        <li class="nav-item @if(Request::is('add_item_category')) menu-open 
            @elseif(Request::is('item_category_list')) menu-open 
            @endif">
          <a href="#" class="nav-link">
            <i class="nav-icon fa fa-user"></i>
            <p>
              Personal Info
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item" style="padding-left : 15px">
              <a href="{{route('add_personal_info')}}" class="nav-link {{ Request::is('add_personal_info') ? 'nav-link active' : ''}}" style="{{ Request::is('add_personal_info') ? 'background-color: #908ec4; !important' : ''}}">
                <i class="far fa-circle nav-icon" style="{{ Request::is('add_personal_info') ? 'color: white; !important' : ''}}"></i>
                <p style="{{ Request::is('add_personal_info') ? 'color: white; !important' : ''}}">Profile</p>
              </a>
            </li>

            <li class="nav-item" style="padding-left : 15px">
              <a href="{{route('password_reset')}}" class="nav-link {{ Request::is('password_reset') ? 'nav-link active' : ''}}" style="{{ Request::is('password_reset') ? 'background-color: #908ec4; !important' : ''}}">
                <i class="far fa-circle nav-icon" style="{{ Request::is('password_reset') ? 'color: white; !important' : ''}}"></i>
                <p style="{{ Request::is('password_reset') ? 'color: white; !important' : ''}}">Password Reset</p>
              </a>
            </li>

          </ul>
        </li>





        @if((auth()->user()->role_id == 1))
        <li class="nav-item @if(Request::is('designation_list')) menu-open 
                              @elseif(Request::is('business_type_list')) menu-open
                              @elseif(Request::is('user_list')) menu-open
          @endif">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-cog"></i>
            <p>
              Settings
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">

            <li class="nav-item">
              <a href="{{route('business_type_list')}}" class="nav-link {{ Request::is('business_type_list') ? 'nav-link active' : ''}}" style="{{ Request::is('business_type_list') ? 'background-color: #908ec4; !important' : ''}}">
                <i class="far fa-circle nav-icon" style="{{ Request::is('business_type_list') ? 'color: white; !important' : ''}}"></i>
                <p style="{{ Request::is('business_type_list') ? 'color: white; !important' : ''}}">Business Type</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="{{route('user_list')}}" class="nav-link {{ Request::is('user_list') ? 'nav-link active' : ''}}" style="{{ Request::is('user_list') ? 'background-color: #908ec4; !important' : ''}}">
                <i class="far fa-circle nav-icon" style="{{ Request::is('user_list') ? 'color: white; !important' : ''}}"></i>
                <p style="{{ Request::is('user_list') ? 'color: white; !important' : ''}}">Users</p>
              </a>
            </li>

          </ul>
        </li>
        @endif

        <div style="padding: 10px 0px 0px 0px;">
          <div style="background-color:#908ec4;height:10px;"></div>
        </div>

        <style>
          .fahadsidebar {
            bottom: 0px;
          }
        </style>

        <div class="fahadsidebar" style="padding: 0px 10px 10px 10px;">
          <br>
          <div style="">
            <p>

              <font color="#e7fdfe" size="4"><b>About Otithee ShopNet</b></font>

            </p>
          </div>
          <div style="text-align: justify;color:#fff;">
            <p>

              <font color="#fff">Otithee ShopNet System is a <br>comprehensive retail solution <br>designed to streamline and <br>optimize shop operations.</font>

            </p>
            <p>
              <font color="#ffdfdf">Efficient Retail <br>Management Solution.</font>
            </p>
            <p>
              <font color="#e7fdfe" size="4"><b>Get in Touch</b></font>
            </p>
            <p>
              <font color="#fff"><b>Address:</b></font>
            </p>

            <p style="margin-top: -15px;">
              <font color="#fef5e7">Police Plaza Concord, Tower-A, <br>
                Floor #8N, 10E, Plot #02, Road <br>#144, Gulshan-1, Dhaka-1212.</font>

            </p>
            <p>
              <font color="#fff"><b>Phone:</b></font>
            </p>

            <p style="margin-top: -15px;">
              <font color="#fef5e7">+8801907802744</font>

            </p>
          </div>
          <br>
          <br>
        </div>


       <!--employee module-->
        @elseif($current_module->module_status == 2)
        @include('partials.emp_sidebar')

        <!--inventory module-->
        @elseif($current_module->module_status == 3) 
        @include('partials.inventory_sidebar')

        <!--pos module-->
        @elseif($current_module->module_status == 4) 
        @include('partials.pos_sidebar')

        <!--asset module-->
        @elseif($current_module->module_status == 5) 
        @include('partials.asset_sidebar')

        @else
        @include('partials.accounts_sidebar')

       @endif
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>