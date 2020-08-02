@can('view_agents')
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Agents<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.agents.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user fa-ad"></i>
                <p>View Agents</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('client.agents.create')}}" class="nav-link">
                <i class="nav-icon fas fa-user fa-ad"></i>
                <p>Add Agent</p>
            </a>
        </li>
    </ul>
</li>
@endcan
@can('view_channels')
<li class="nav-item">
    <a href="{{ route('client.channel.view')}}" class="nav-link">
        <i class="nav-icon fas fa-user fa-ad"></i>
        <p>Channel Page</p>
    </a>
</li>
@endcan

<li class="nav-item has-treeview {!! Request::is('client/contents/*') ? 'active' : '' !!}">
    <a href="#" class="nav-link ">
        <i class="nav-icon fas fa-video"></i>
        <p>Content<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('client.contents.index')}}" class="nav-link">
                <i class="nav-icon fas fa-ad fa-video"></i>
                <p>View Content List</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('client.contents.create')}}" class="nav-link">
                <i class="nav-icon fas fa-video fa-ad"></i>
                <p>Add Content</p>
            </a>
        </li>
    </ul>
</li>