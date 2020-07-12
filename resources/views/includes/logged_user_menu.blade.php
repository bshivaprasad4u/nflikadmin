<div class="logged-user-menu color-style-bright">
    <div class="logged-user-avatar-info">
        <div class="avatar-w">
            <img alt="" src="img/avatar1.jpg">
        </div>
        <div class="logged-user-info-w">
            <div class="logged-user-name">
                @auth
                {{ Auth::user()->name }}
                @endauth

            </div>
            <div class="logged-user-role">
                @if(Auth::getDefaultDriver()== 'admin')
                {{ 'Administrator' }}
                @elseif(Auth::getDefaultDriver()== 'client')
                {{ 'Client    ' }}
                @elseif(Auth::getDefaultDriver()== 'agent')
                Agent
                @endif
            </div>
        </div>
    </div>
    <div class="bg-icon">
        <i class="os-icon os-icon-wallet-loaded"></i>
    </div>
    <ul>
        <li>
            <a href="apps_email.html"><i class="os-icon os-icon-mail-01"></i><span>Incoming Mail</span></a>
        </li>
        <li>
            <a href="users_profile_big.html"><i class="os-icon os-icon-user-male-circle2"></i><span>Profile Details</span></a>
        </li>
        <li>
            <a href="users_profile_small.html"><i class="os-icon os-icon-coins-4"></i><span>Billing Details</span></a>
        </li>
        <li>
            <a href="#"><i class="os-icon os-icon-others-43"></i><span>Notifications</span></a>
        </li>
        <li>
            @if(Auth::getDefaultDriver()== 'admin')
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @elseif(Auth::getDefaultDriver()== 'client')
            <a href="{{ route('client.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('client.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @elseif(Auth::getDefaultDriver()== 'agent')
            <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @else
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="os-icon os-icon-signs-11"></i><span>Logout</span></a>
            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            @endif
        </li>
    </ul>
</div>