  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
          <li class="nav-item">
              <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
          <!-- <li class="nav-item d-none d-sm-inline-block">
              <a href="../../index3.html" class="nav-link">Home</a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
              <a href="#" class="nav-link">Contact</a>
          </li> -->
      </ul>

      <!-- SEARCH FORM -->
      <form class="form-inline ml-3">
          <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search" />
              <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                      <i class="fas fa-search"></i>
                  </button>
              </div>
          </div>
      </form>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          {{-- @include('adminlte.includes.messages')
          @include('adminlte.includes.notifications') --}}
          <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                  <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="user-image img-circle elevation-2" alt="User Image" />
                  <span class="d-none d-md-inline">@auth
                      {{ ucfirst(Auth::user()->name) }}
                      @endauth</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                  <!-- User image -->
                  <li class="user-header bg-primary">
                      <img src="{{ asset('adminlte/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image" />

                      <p>
                          @auth
                          {{ ucfirst(Auth::user()->name) }}
                          @endauth - @if(Auth::getDefaultDriver()== 'admin')
                          Administrator
                          @elseif(Auth::getDefaultDriver()== 'client')
                          Client
                          @elseif(Auth::getDefaultDriver()== 'agent')
                          Agent
                          @endif
                          <!-- <small>Member since {{@ Auth::user()->created_at }};</small> -->
                      </p>
                  </li>

                  <!-- Menu Footer-->
                  <li class="user-footer">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>

                      @if(Auth::getDefaultDriver()== 'admin')
                      <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign out</a>
                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      @elseif(Auth::getDefaultDriver()== 'client')
                      <a href="{{ route('client.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign out</a>
                      <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      @elseif(Auth::getDefaultDriver()== 'agent')
                      <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign out</a>
                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      @else
                      <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="btn btn-default btn-flat float-right">Sign out</a>
                      <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                      @endif
                  </li>
              </ul>
          </li>
          <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
      </ul>
  </nav>
  <!-- /.navbar -->