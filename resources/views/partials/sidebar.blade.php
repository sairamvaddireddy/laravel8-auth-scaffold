<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
    <div class="sidebar-brand-text mx-3">{{ config('app.name') }}</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item @if(Route::is('home')) active @endif">
    <a class="nav-link" href="{{ route('home') }}">
        <i class="fas fa-fw fa-tachometer-alt"></i>
        <span>Dashboard</span></a>
</li>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Heading -->
<!-- <div class="sidebar-heading">
    Interface
</div> -->

<!-- Nav Item - Users Collapse Menu -->
@can('user-list')
<li class="nav-item @if(Route::is('users.*')) active @endif">
    <a class="nav-link @if(!Route::is('users.*')) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseUsers"
        aria-expanded="true" aria-controls="collapseUsers">
        <i class="fas fa-users"></i>
        <span>Users</span>
    </a>
    <div id="collapseUsers" class="collapse @if(Route::is('users.*')) show @endif" aria-labelledby="collapseUsers" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('user-create')<a class="collapse-item @if(Route::is('users.create')) active @endif" href="{{ route('users.create') }}">Create User</a>@endcan
            <a class="collapse-item @if(Route::is('users.index')) active @endif" href="{{ route('users.index') }}">Users List</a>
        </div>
    </div>
</li>
@endcan

@can('role-list')
<li class="nav-item @if(Route::is('roles.*')) active @endif">
    <a class="nav-link @if(!Route::is('roles.*')) collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseRoles"
        aria-expanded="true" aria-controls="collapseRoles">
        <i class="fas fa-users"></i>
        <span>Roles</span>
    </a>
    <div id="collapseRoles" class="collapse @if(Route::is('roles.*')) show @endif" aria-labelledby="collapseRoles" data-parent="#accordionSidebar">
        <div class="bg-white py-2 collapse-inner rounded">
            @can('role-create')
                <a class="collapse-item @if(Route::is('roles.create')) active @endif" href="{{ route('roles.create') }}">Create Role</a>
            @endcan
            <a class="collapse-item @if(Route::is('roles.index')) active @endif" href="{{ route('roles.index') }}">Roles List</a>
        </div>
    </div>
</li>
@endcan

<li class="nav-item @if(Route::is('tokens.*')) active @endif">
    <a class="nav-link" href="{{ route('tokens.index') }}">
        <i class="fas  fa-key fa-sm fa-fw mr-2"></i>
        Tokens
    </a>
</li>

<li class="nav-item @if(Route::is('settings.*')) active @endif">
    <a class="nav-link" href="{{ route('settings.index') }}">
        <i class="fas fa-sliders-h fa-sm fa-fw mr-2"></i>
        Additional Settings
    </a>
</li>
<!-- Divider -->
<hr class="sidebar-divider">

<!-- Nav Item - Tables -->
<li class="nav-item">
    <a class="nav-link" href="#" data-toggle="modal" data-target="#logoutModal">
        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
        Logout
    </a>
</li>
<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>
</ul>
<!-- End of Sidebar -->