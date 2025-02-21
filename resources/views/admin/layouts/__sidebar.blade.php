@php
    $user = Auth::user();
@endphp

<div id="sidebar">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header position-relative">
            <div class="d-flex justify-content-between align-items-center">
                <div class="logo">
                    <h4 class="pt-2">
                        <a href="{{ url('index') }}" class="">Restoranku</a>
                    </h4>
                </div>
                <div class="theme-toggle d-flex gap-2 align-items-center mt-2">
                    <!-- Theme toggle code here -->
                </div>
                <div class="sidebar-toggler x">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <li class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ request()->routeIs('orders.*') ? 'active' : '' }}">
                    <a href="{{ route('orders.index') }}" class='sidebar-link'>
                        <i class="bi bi-cart-fill"></i>
                        <span>Kelola Pesanan</span>
                    </a>
                </li>
                @if(Auth::user()->role->role_name == 'admin')


                    <li class="sidebar-item {{ request()->routeIs('items.*') ? 'active' : '' }}">
                        <a href="{{ route('items.index') }}" class='sidebar-link'>
                            <i class="bi bi-file-earmark-text-fill"></i>
                            <span>Daftar Menu</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('users.*') ? 'active' : '' }}">
                        <a href="{{ route('users.index') }}" class='sidebar-link'>
                            <i class="bi bi-person-fill"></i>
                            <span>Manajemen Karyawan</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('roles.*') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class='sidebar-link'>
                            <i class="bi bi-person-fill-gear"></i>
                            <span>Manajemen Role</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ request()->routeIs('categories.*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}" class='sidebar-link'>
                            <i class="bi bi-tags-fill"></i>
                            <span>Manajemen Kategori</span>
                        </a>
                    </li>
                @endif
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" class='sidebar-link' onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>{{ __('Log Out') }}</span>
                        </a>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>
