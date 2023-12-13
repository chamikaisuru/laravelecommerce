<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ url('admin/dashboard') }}" class="brand-link">
      <img src="{{ asset ('admin/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @if (!empty(Auth::guard('admin')->user()->image))
          <img src="{{ url('admin/img/photos/'.Auth::guard('admin')->user()->image)}}" class="img-circle elevation-2" alt="User Image">
          @else
          <img src="{{ asset ('admin/img/user-avatar.png') }}" class="img-circle elevation-2" alt="User Image">
          @endif
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               @if (Session::get('page') =='dashboard')
                        @php
                        $active='active';
                        @endphp
                   @else
                        @php
                            $active = "";
                        @endphp
               @endif
               <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $active }}" >
                  <i class="nav-icon fas fa-th"></i>
                  <p>Dashboard</p>
                </a>
              </li>
              @if (Session::get('page') =='updatePassword' || Session::get('page') =='updateAdminDetails')
                @php
                    $active='active';
                @endphp
            @else
                @php
                    $active = "";
                @endphp
            @endif

            @if(Auth::guard('admin')->user()->type=="admin")
               <li class="nav-item menu-open">
            <a href="#" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                @if (Session::get('page') =='updatePassword')
                    @php
                        $active='active';
                    @endphp
                @else
                    @php
                        $active = "";
                    @endphp
                @endif
                <a href="{{ url('admin/updatePassword') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Password</p>
                </a>
              </li>
              <li class="nav-item">
                @if (Session::get('page') =='updateAdminDetails')
                    @php
                    $active='active';
                    @endphp
                @else
                    @php
                        $active = "";
                    @endphp
                @endif
                <a href="{{ route('admin.updateAdminDetails') }}" class="nav-link {{ $active }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Admin Details</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            @if (Session::get('page') =='sub-admin')
            @php
            $active='active';
            @endphp
            @else
            @php
                $active = "";
            @endphp
            @endif
            <a href="{{ route('admin.subadmin') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-users"></i>
              <p>SubAdmins</p>
            </a>

          </li>
          @endif



          <li class="nav-item">
            @if (Session::get('page') =='cms-pages')
            @php
            $active='active';
            @endphp
        @else
            @php
                $active = "";
            @endphp
        @endif
            <a href="{{ route('admin.cms-Pages') }}" class="nav-link {{ $active }}">
              <i class="nav-icon fas fa-copy"></i>
              <p>CMS Pages
                {{-- <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span> --}}
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/layout/top-nav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Top Navigation + Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/boxed.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Boxed</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-sidebar-custom.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Sidebar <small>+ Custom Area</small></p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-topnav.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Navbar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/fixed-footer.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fixed Footer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/layout/collapsed-sidebar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Collapsed Sidebar</p>
                </a>
              </li>
            </ul> --}}
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
