<div class="vertical-menu">

    <div data-simplebar class="h-100">

        @php
            $id = Auth::user()->id;
            $adminData = App\Models\User::find($id);
        @endphp
        <!-- User details -->
        <div class="mt-3 text-center user-profile">
            <div class="flex justify-center">
                <img src="{{ !empty($adminData->profile_image) ? url($adminData->profile_image) : url('upload/no_image.jpg') }}"
                    alt="" class="avatar-md rounded-circle">
            </div>
            <div class="mt-3">
                <h4 class="mb-1 font-size-16">{{ $adminData->name }}</h4>
                <span class="text-muted"><i class="align-middle ri-record-circle-line font-size-14 text-success"></i>
                    Online</span>
            </div>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ route('dashboard') }}" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        {{-- <span class="badge rounded-pill bg-success float-end">3</span> --}}
                        <span>Dashboard</span>
                    </a>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Suppliers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.suppliers') }}">All Suppliers</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Customers</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.customers') }}">All Customers</a></li>
                        <li><a href="{{ route('credit.customers') }}">Credit Customers</a></li>
                        <li><a href="{{ route('customers.purchases') }}">Customers Purchases</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Units</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.units') }}">All Units</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Category</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.categories') }}">All Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Products</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.products') }}">All Products</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Purchase</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.purchases') }}">All Purchases</a></li>
                        {{-- @if (Auth::user()->role_id == 3) --}}
                        @if (Auth::user()->role_id == 3)
                            <li><a href="{{ route('pending.purchases') }}">Approval Purchases</a></li>
                        @endif
                        @if (Auth::user()->role_id == 1)
                            <li><a href="{{ route('receive.purchases.all') }}">Receive Purchases</a></li>
                        @endif
                        <li><a href="{{ route('receive.purchases.incomplete') }}">Incomplete Received Purchases</a>
                        </li>
                        {{-- @endif --}}
                        <li><a href="{{ route('purchase.report') }}">Daily Purchase Report</a></li>
                    </ul>

                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Manage Invoices</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('all.invoices') }}">All Invoices</a></li>
                        {{-- @if (Auth::user()->role_id == 2) --}}
                        @if (Auth::user()->role_id == 2)
                            <li><a href="{{ route('pending.invoices') }}">Approval Invoice</a></li>
                        @endif
                        {{-- @endif --}}
                        <li><a href="{{ route('daily.invoice.report') }}">Daily Invoice Report</a></li>
                    </ul>

                </li>
                {{-- @if (Auth::user()->role_id == 3) --}}

                {{-- @endif --}}



                <li class="menu-title">Stock</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-account-circle-line"></i>
                        <span>Manage Stock</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('stock.report') }}">Stock Report</a></li>
                        <li><a href="{{ route('supplier.report') }}">Supplier Wise Report</a></li>

                    </ul>
                </li>
                @if (Auth::user()->role_id >= 3)
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-mail-send-line"></i>
                            <span>Manage Employees</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.employees') }}">All Employees</a></li>
                        </ul>

                    </li>
                @endif
                @if (Auth::user()->role_id == 4)
                    <li>
                        <a href="javascript: void(0);" class="has-arrow waves-effect">
                            <i class="ri-mail-send-line"></i>
                            <span>Manage Regions</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="{{ route('all.regions') }}">All Regions</a></li>
                        </ul>

                    </li>
                @endif




            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
