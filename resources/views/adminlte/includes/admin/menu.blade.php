<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-user"></i>
        <p>Clients<i class="right fas fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{ route('admin.clients.index')}}" class="nav-link">
                <i class="nav-icon fas fa-user fa-ad"></i>
                <p>View Clients</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin.clients.create')}}" class="nav-link">
                <i class="nav-icon fas fa-user fa-ad"></i>
                <p>Add Client</p>
            </a>
        </li>
    </ul>
</li>