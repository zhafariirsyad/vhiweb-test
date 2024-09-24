<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        @if (Auth::guard('web')->check())
            @include('dashboard.menus.index')
        @elseif (Auth::guard('vendor')->check())
            @include('vendor.menus.index')
        @endif
    </aside>
</div>
