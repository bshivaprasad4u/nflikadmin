<div class="logo-w">
    <a class="logo" href="{{ url ('/') }}">
        <div class="logo-element"></div>
        <div class="logo-label">
            {{ config('app.name') }} Admin
        </div>
    </a>
</div>
<div class="logged-user-w avatar-inline">
    <div class="logged-user-i">
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
                Administrator
                @elseif(Auth::getDefaultDriver()== 'client')
                Client
                @elseif(Auth::getDefaultDriver()== 'agent')
                Agent
                @endif
            </div>
        </div>
        <div class="logged-user-toggler-arrow">
            <div class="os-icon os-icon-chevron-down"></div>
        </div>

        @include('includes.logged_user_menu')
    </div>
</div>