<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar">
    <ul class="navbar-nav mr-auto">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">

                @if (Auth::guard('web')->check())
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::user()->name }}</div></a>
                @elseif (Auth::guard('vendor')->check())
                    <div class="d-sm-none d-lg-inline-block">Hi, {{ Auth::guard('vendor')->user()->company_name }}</div></a>
                @endif

            <div class="dropdown-menu dropdown-menu-right">
                @php
                    if (Auth::guard('web')->check()){
                        $logoutRoute = route('admin.logout');
                    }elseif (Auth::guard('vendor')->check()){
                        $logoutRoute = route('vendor.logout');
                    }
                @endphp
                <a href="{{ $logoutRoute }}" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
