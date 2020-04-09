<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Đồ án <sup>3</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Pages Collapse Menu -->
    @foreach (config('variables.menus') as $key => $menu)
    <li class="nav-item">
        <a class="nav-link collapsed" href="{{ $menu['submenu'] == null ? url($menu['url']) : 'void:javascript(0)' }}"
            data-toggle="{{ $menu['submenu'] == null ? '' : 'collapse' }}" data-target="#{{ $key }}"
            aria-expanded="true" aria-controls="collapseTwo">
            {!! $menu['icon'] !!}
            <span>{{ $menu['name'] }}</span>
        </a>
        @if ($menu['submenu'])
        <div id="{{ $key }}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                @foreach ($menu['submenu'] as $submenu)
                <a class="collapse-item" href="{{ url($submenu['url']) }}">{{ $submenu['name'] }}</a>
                @endforeach
            </div>
        </div>
        @endif
    </li>

    <!-- Divider -->
    @endforeach
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>