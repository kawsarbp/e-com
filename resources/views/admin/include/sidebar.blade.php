<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.dashboard')}}" class="brand-link">
        <img src="/assets/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('image/admin/admin_images/'.Auth::guard('admin')->user()->photo)}}"
                     style="height: 33px;"
                     class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.dashboard')}}" class="d-block">{{Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                       aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}"
                       class="nav-link  {{request()->is('admin/dashboard')?'active':''}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                {{--settings--}}

                <li class="nav-item {{request()->is('admin/settings') ?'menu-open':'' }} {{request()->is('admin/update-admin-details') ?'menu-open':'' }} ">
                    <a href="#"
                       class="nav-link {{request()->is('admin/settings') ?'active':'' }} {{request()->is('admin/update-admin-details') ?'active':'' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p> Settings </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <li class="nav-item">
                            <a href="{{  route('admin.settings')  }}"
                               class="nav-link {{request()->is('admin/settings') ?'active':'' }}">
                                <p>Update Admin Password</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.admindetails') }}"
                               class="nav-link {{request()->is('admin/update-admin-details') ?'active':'' }}">
                                <p>Update Admin Details</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{--catalogues--}}

                <li class="nav-item  {{request()->is('admin/sections') ?'menu-open':'' }} {{request()->is('admin/banners') ?'menu-open':'' }} {{request()->is('admin/brands') ?'menu-open':'' }} {{request()->is('admin/add-edit-product') ?'menu-open':'' }} {{request()->is('admin/products') ?'menu-open':'' }} {{request()->is('admin/categories') ?'menu-open':'' }} {{request()->is('admin/add-edit-category') ?'menu-open':'' }} {{request()->is('admin/coupons') ?'menu-open':'' }} {{request()->is('admin/orders') ?'menu-open':'' }}{{request()->is('admin/view-shipping-charges') ?'menu-open':'' }}">
                    <a href="#"
                       class="nav-link {{request()->is('admin/sections') ?'active':'' }} {{request()->is('admin/banners') ?'active':'' }}  {{request()->is('admin/products') ?'active':'' }} {{request()->is('admin/brands') ?'active':'' }} {{request()->is('admin/add-edit-product') ?'active':'' }} {{request()->is('admin/categories') ?'active':'' }} {{request()->is('admin/add-edit-category') ?'active':'' }} {{request()->is('admin/coupons') ?'active':'' }} {{request()->is('admin/orders') ?'active':'' }}{{request()->is('admin/view-shipping-charges') ?'active':'' }}">
                        <i class="nav-icon fas fa-th"></i>
                        <p> Catalogues </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{  route('admin.sections')  }}"
                               class="nav-link {{request()->is('admin/sections') ?'active':'' }}">
                                <p>Section</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="{{ route('admin.categories') }}"
                               class="nav-link  {{request()->is('admin/categories') ?'active':'' }} {{request()->is('admin/add-edit-category') ?'active':'' }} ">
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.products')  }}"
                               class="nav-link {{request()->is('admin/add-edit-product') ?'active':'' }} {{request()->is('admin/products') ?'active':'' }}">
                                <p>Products</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.brands')  }}"
                               class="nav-link {{request()->is('admin/brands') ?'active':'' }}">
                                <p>Brands</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.banners')  }}"
                               class="nav-link {{request()->is('admin/banners') ?'active':'' }}">
                                <p>Banners</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.coupons')  }}"
                               class="nav-link {{request()->is('admin/coupons') ?'active':'' }}">
                                <p>Coupons</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.orders')  }}"
                               class="nav-link {{request()->is('admin/orders') ?'active':'' }}">
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{  route('admin.shippingCharges')  }}"
                               class="nav-link {{request()->is('admin/view-shipping-charges') ?'active':'' }}">
                                <p>Shipping Charges</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
    </div>
</aside>
