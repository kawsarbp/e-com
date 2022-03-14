<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="/assets/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{url('image/admin/admin_image/'.Auth::guard('admin')->user()->photo)}}" style="height: 35px;" class="img-circle elevation-2" alt="User Image">
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
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(Session::get('page') == 'dashboard')
                    <?php $active = 'active' ?>
                @else
                    <?php $active = '' ?>
                @endif
                <li class="nav-item">
                    <a href="{{route('admin.dashboard')}}" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p> Dashboard </p>
                    </a>
                </li>
                @if(Session::get('page') == 'settings' || Session::get('page') == 'update-admin-details')
                    <?php $active = 'active' ?>
                @else
                    <?php $active = '' ?>
                @endif
                <li class="nav-item menu-open">
                    <a href="#" class="nav-link {{$active}}">
                        <i class="nav-icon fas fa-th"></i>
                        <p> Settings </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(Session::get('page') == 'settings')
                            <?php $active = 'active' ?>
                        @else
                            <?php $active = '' ?>
                        @endif
                        <li class="nav-item">
                            <a href="{{  route('admin.settings')  }}" class="nav-link {{$active}}">
                                <p>Update Admin Password</p>
                            </a>
                        </li>
                            @if(Session::get('page') == 'update-admin-details')
                                <?php $active = 'active' ?>
                            @else
                                <?php $active = '' ?>
                            @endif
                        <li class="nav-item">
                            <a href="{{ route('admin.admindetails') }}" class="nav-link {{$active}}">
                                <p>Update Admin Details</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>
