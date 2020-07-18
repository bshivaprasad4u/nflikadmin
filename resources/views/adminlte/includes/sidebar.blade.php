<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary  elevation-4">
    @if(Auth::getDefaultDriver()== 'admin')
    <a href="{{ route('admin.dashboard')}}" class="brand-link">
        @elseif(Auth::getDefaultDriver()== 'client')
        <a href="{{ route('client.dashboard')}}" class="brand-link">
            @elseif(Auth::getDefaultDriver()== 'agent')
            <a href="{{ route('agent.dashboard')}}" class="brand-link">
                @else
                <a href="{{ url('/')}}" class="brand-link">
                    @endif
                    <!-- Brand Logo -->

                    <img src="{{ asset('adminlte/img/logo.png')}}" alt="Nflik Logo" class="brand-image">
                    <span class="brand-text font-weight-light">Admin</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <!-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Alexander Pierce</a>
            </div>
        </div> -->

                    <!-- Sidebar Menu -->
                    <nav class="mt-2">
                        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                            <li class="nav-item has-treeview">
                                <a href="{{ route('admin.clients.index')}}" class="nav-link">
                                    <i class="nav-icon fas fa-user"></i>
                                    <p>Clients<i class="right fas fa-angle-left"></i></p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.clients.create')}}" class="nav-link">
                                            <i class="nav-icon fas fa-user fa-ad"></i>
                                            <p>Add Client</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>




                        </ul>
                    </nav>
                    <!-- /.sidebar-menu -->
                </div>
                <!-- /.sidebar -->
</aside>