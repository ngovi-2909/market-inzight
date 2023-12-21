<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-category">Management</li>

        @if(auth()->user()->is_super_user)
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="{{route('users.index')}}" aria-expanded="false"
                   aria-controls="ui-basic">
                    <i class="menu-icon mdi mdi-account"></i>
                    <span class="menu-title">Users</span>
                    <i class="menu-arrow"></i>
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="{{route('emails.index')}}" aria-expanded="false"
               aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-animation"></i>
                <span class="menu-title">Emails IP</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="{{route('proxies.index')}}" aria-expanded="false"
               aria-controls="ui-basic">
                <i class="menu-icon mdi mdi-apple-finder"></i>
                <span class="menu-title">Proxies IP</span>
                <i class="menu-arrow"></i>
            </a>
        </li>

    </ul>
</nav>
