
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="treeview">
              <a href="{{ route('home') }}">
                <i class="fa fa-dashboard"></i> <span class="header">Dashboard</span>
              </a>
            </li>


            <li class="treeview {{ Request::is('administrator/products*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-plus-square"></i>
                <span>management</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('users-list')
                <li class=""><a href="{{ route('users.index') }}"><i class="fa fa-shopping-cart"></i>Staff</a></li>
                @endcan
                @can('role-list')
                <li class="{{ Request::is('administrator/banks/create')? 'active' :''  }}"><a href="{{ route('roles.index') }}"><i class="fa fa-plus-square"></i> Roles </a></li>
                @endcan
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/products*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-sellsy"></i>
                <span>Sales</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('transaction-list')
                <li class=""><a href="{{url('transcation')}}"><i class="fa fa-shopping-cart"></i>Sale </a></li>
                <li class="{{ Request::is('administrator/banks/create')? 'active' :''  }}"><a href="{{url('/transcation/history')}}"><i class="fa fa-plus-square"></i>View Sales</a></li>
                @endcan
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/customers*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-shopping-cart"></i>
                <span>Stocks</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('product-list')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{route('products.index')}}"><i class="fa fa-dropbox"></i>View Stocks</a></li>
                @endcan
              </ul>
              <ul class="treeview-menu">
              @can('product-create')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{ url('/products/create')}}"><i class="fa fa-dropbox"></i>Add Stocks</a></li>
                @endcan
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/customers*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-dropbox"></i>
                <span>Customers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('client-list')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{ route('client.index') }}"><i class="fa fa-bars"></i> Customers </a></li>
                @endcan
                @can('client-create')
                <li class="{{ Request::is('administrator/clients/create')? 'active' :''  }}"><a href="{{ route('client.create') }}"><i class="fa fa-plus-circle"></i> Add Customers</a></li>
                @endcan
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/suppliers*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-folder-o"></i>
                <span>Suppliers</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('supplier-list')
                <li class="{{ Request::is('administrator/suppliers')? 'active' :''  }}"><a href="{{ route('supplier.index') }}"><i class="fa fa-bars"></i> Suppliers </a></li>
                @endcan
                @can('supplier-create')
                <li class="{{ Request::is('administrator/suppliers/create')? 'active' :''  }}"><a href="{{ route('supplier.create') }}"><i class="fa fa-plus-circle"></i> Add Suppliers</a></li>@endcan
              </ul>
            </li>


            <li class="treeview {{ Request::is('admin/repair-product*')? 'active' :''  }}">
                  <a href="#">
                      <i class="fa fa-wrench"></i>
                      <span>Purchases</span>
                      <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                  @can('workshop-list')
                      <li class="{{ Request::is('admin/repair-product')? 'active' :''  }}">
                          <a href="{{ route('purchase.index') }}"><i class="fa fa-list-alt"></i> View Purchases</a>
                      </li>
                      @endcan
                      @can('workshop-create')
                      <li class="{{ Request::is('admin/repair-product/create')? 'active' :''  }}"><a href="{{ route('purchase.create') }}"><i class="fa fa-plus-square-o"></i>Add Purchases</a></li>
                      @endcan
                  </ul>
              </li>


            <li class="treeview {{ Request::is('administrator/customers*')? 'active' :''  }}">
              <a href="#">
              <i class="fa fa-bars"></i>
                <span>P.o.s</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('bank-list')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{ route('bank.index') }}"> <i class="fa fa-dropbox"></i></i>Transactions</a></li>
                @endcan
                @can('bank-create')
                <li class="{{ Request::is('administrator/customers/create')? 'active' :''  }}"><a href="{{ route('bank.create') }}"><i class="fa fa-plus-circle"></i> Add Transactions</a></li>
                @endcan
              </ul>
            </li>


            <li class="treeview {{ Request::is('administrator/customers*')? 'active' :''  }}">
              <a href="#">
              <i class="fa fa-bars"></i>
                <span>Payments</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('payment-list')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{ route('payment.index') }}"> <i class="fa fa-dropbox"></i></i>View payments</a></li>
                @endcan
                @can('payment-create')
                <li class="{{ Request::is('administrator/customers/create')? 'active' :''  }}"><a href="{{ route('payment.create') }}"><i class="fa fa-plus-circle"></i> Add payments</a></li>
                @endcan
              </ul>
            </li>


            <li class="treeview {{ Request::is('administrator/customers*')? 'active' :''  }}">
              <a href="#">
              <i class="fa fa-bars"></i>
                <span>Outstanding</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('outstanding-list')
                <li class="{{ Request::is('administrator/customers')? 'active' :''  }}"><a href="{{ route('outstanding.index') }}"> <i class="fa fa-dropbox"></i></i>View outstanding</a></li>
                @endcan
                @can('outstanding-create')
                <li class="{{ Request::is('administrator/customers/create')? 'active' :''  }}"><a href="{{ route('outstanding.create') }}"><i class="fa fa-plus-circle"></i> Add Outstanding</a></li>
                @endcan
              </ul>
            </li>

            <li class="treeview {{ Request::is('administrator/products*')? 'active' :''  }}">
              <a href="#">
              <i class="fa fa-list-alt"></i>
                <span>Income/Expenses</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
              @can('incomes-list')
                <li class="nav-item {{ Route::currentRouteName() == 'incomes.index' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('incomes.index') }}">
                    <i class="fa fa-dropbox"></i>
                    <span>Incomes</span></a>
                </li>
                @endcan
                @can('expense-list')
                <li class="nav-item {{ Route::currentRouteName() == 'expense.index' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('expense.index') }}">
                    <i class="fa fa-plus-square"></i>
                    <span>Expenses</span></a>
                </li>
                @endcan
                @can('summary-list')
                <li class="nav-item {{ Route::currentRouteName() == 'summary' ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('expenses.summary') }}">
                    <i class="fa fa-sellsy"></i>
                    <span>All Summary</span></a>
                </li>
                @endcan
              </ul>
            </li>


            <li class="treeview {{ Request::is('administrator/products*')? 'active' :''  }}">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Rest password</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li class="nav-item {{ Route::currentRouteName() == 'incomes.index' ? 'active' : '' }}">
                    <a class="nav-link" href="{{url('change-password')}}">
                    <i class="fa fa-bars"></i>
                    <span>Change Password</span></a>
                </li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
