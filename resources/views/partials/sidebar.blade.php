<!-- sidebar menu area start -->
<div class="sidebar-menu">
    <div class="sidebar-header">
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{ asset('assets/images/icon/logo.png') }}" alt="logo"></a>
        </div>
    </div>
    <div class="main-menu">
        <div class="menu-inner">
            <nav>
                <ul class="metismenu" id="menu">
                    <li class="active">
                        <a href="{{ route('home') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('role.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>Role Management</span></a>
                    </li>
                    <li>
                        <a href="{{ route('users.index') }}" aria-expanded="true"><i class="ti-dashboard"></i><span>User Management</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
