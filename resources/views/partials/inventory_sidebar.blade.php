<li class="nav-item nav-link 
            @if(Request::is('inventory_module_active')) nav-link active
            @endif
            " style="@if(Request::is('inventory_module_active')) background-color: #1cdf1c;
              @endif
              ">
        <a href="{{route('home')}}">
          <i class="nav-icon fas fa-tachometer-alt" style="@if(Request::is('inventory_module_active')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('inventory_module_active')) color:white;
              @endif
              ">
            Dashboard
          </p>
        </a>
      </li>

      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(12, $permitted_menus_array)))
      <li class="nav-item @if(Request::is('add_item_category')) menu-open 
            @elseif(Request::is('item_category_list')) menu-open 
            @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-layer-group"></i>
          <p>
            Item Category
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('add_item_category')}}" class="nav-link {{ Request::is('add_item_category') ? 'nav-link active' : ''}}" style="{{ Request::is('add_item_category') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('add_item_category') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('add_item_category') ? 'color: white; !important' : ''}}">Add Item Category</p>
            </a>
          </li>


          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('item_category_list')}}" class="nav-link {{ Request::is('item_category_list') ? 'nav-link active' : ''}}" style="{{ Request::is('item_category_list') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('item_category_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('item_category_list') ? 'color: white; !important' : ''}}">Item Category List</p>
            </a>
          </li>
        </ul>
      </li>
      @endif


      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(13, $permitted_menus_array)))
      <li class="nav-item @if(Request::is('add_product_category')) menu-open 
            @elseif(Request::is('product_category_list')) menu-open 
            @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-window-restore"></i>
          <p>
            Product Category
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('add_product_category')}}" class="nav-link {{ Request::is('add_product_category') ? 'nav-link active' : ''}}" style="{{ Request::is('add_product_category') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('add_product_category') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('add_product_category') ? 'color: white; !important' : ''}}">Add Product Category</p>
            </a>
          </li>

          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('product_category_list')}}" class="nav-link {{ Request::is('product_category_list') ? 'nav-link active' : ''}}" style="{{ Request::is('product_category_list') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('product_category_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('product_category_list') ? 'color: white; !important' : ''}}">Product Category List</p>
            </a>
          </li>
        </ul>
      </li>
      @endif

      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(14, $permitted_menus_array)))
      <li class="nav-item @if(Request::is('add_product')) menu-open 
            @elseif(Request::is('product_list')) menu-open
            @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fas fa-gem"></i>
          <p>
            Product
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('add_product')}}" class="nav-link {{ Request::is('add_product') ? 'nav-link active' : ''}}" style="{{ Request::is('add_product') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('add_product') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('add_product') ? 'color: white; !important' : ''}}">Add Product</p>
            </a>
          </li>
          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('product_list')}}" class="nav-link {{ Request::is('product_list') ? 'nav-link active' : ''}}" style="{{ Request::is('product_list') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('product_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('product_list') ? 'color: white; !important' : ''}}">Product List</p>
            </a>
          </li>
        </ul>
      </li>
      @endif


      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(15, $permitted_menus_array)))
      @if(Auth::user()->review_requisition == 1)
      <li class="nav-item @if(Request::is('requisition_list')) menu-open @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-box"></i>
          <p>
            Product Purchase
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">


          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('requisition_list')}}" class="nav-link {{ Request::is('requisition_list') ? 'nav-link active' : ''}}" style="{{ Request::is('requisition_list') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('requisition_list') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('requisition_list') ? 'color: white; !important' : ''}}">Purchased Products</p>
            </a>
          </li>
        </ul>
      </li>
      @endif
      @endif


      @if((Auth::user()->role_id == 1) || (Auth::user()->role_id == 2) || (in_array(16, $permitted_menus_array)))
      <li class="nav-item nav-link 
            @if(Request::is('stock_list')) nav-link active
            @endif
            " style="@if(Request::is('stock_list')) background-color: #1cdf1c;
              @endif
              ">
        <a href="{{route('stock_list')}}">
          <i class="nav-icon fa-solid fa-layer-group" style="@if(Request::is('stock_list')) color: white;
              @endif
              ">
          </i>
          <p style="@if(Request::is('stock_list')) color:white;
              @endif
              ">
            Stock
          </p>
        </a>
      </li>
      @endif

  
      @if((Auth::user()->role_id == 1) ||  (Auth::user()->role_id == 2))
      <li class="nav-item 
      @if(Request::is('damage_report')) menu-open 
      @elseif(Request::is('purchase_report')) menu-open 
            @endif">
        <a href="#" class="nav-link">
          <i class="nav-icon fa-solid fa-file-pen"></i>
          <p>
             Reports
            <i class="fas fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">

          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('damage_report')}}" class="nav-link {{ Request::is('damage_report') ? 'nav-link active' : ''}}" style="{{ Request::is('damage_report') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('damage_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('damage_report') ? 'color: white; !important' : ''}}">Damaged Product Report</p>
            </a>
          </li>

          <li class="nav-item" style="padding-left : 15px">
            <a href="{{route('purchase_report')}}" class="nav-link {{ Request::is('purchase_report') ? 'nav-link active' : ''}}" style="{{ Request::is('purchase_report') ? 'background-color: #1cdf1c; !important' : ''}}">
              <i class="far fa-circle nav-icon" style="{{ Request::is('purchase_report') ? 'color: white; !important' : ''}}"></i>
              <p style="{{ Request::is('purchase_report') ? 'color: white; !important' : ''}}">Purchase Report</p>
            </a>
          </li>

        </ul>
      </li>
      @endif